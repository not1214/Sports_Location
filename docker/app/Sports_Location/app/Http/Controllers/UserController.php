<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Models\User;
use App\Models\Event;
use App\Models\Reservation;
use App\Models\Favorite;
use App\Models\Relationship;

class UserController extends Controller
{
    public function myPage()
    {
        $user = Auth::user();
        $followings = Relationship::where('following_id', $user->id)->get();
        $followers = Relationship::where('followed_id', $user->id)->get();
        return view('user/myPage', compact('user', 'followings', 'followers'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('user/edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $user->username = $request->username;
        $user->introduction = $request->introduction;

        if (!empty($request->profile_image)) {
            Storage::delete($user->profile_image);
            $image = $request->profile_image;
            $path = $image->store('public/user');
            $read_path = str_replace('public/', 'storage/', $path);
            $user->profile_image = $read_path;
        }

        $user->save();
        return redirect()->route('user.myPage');
    }

    public function unsubscribe()
    {
        return view('user/unsubscribe');
    }

    public function withdraw()
    {
        $user = Auth::user();
        $user->delete();
        Auth::logout();
        return redirect('/');
    }

    public function createdEvents()
    {
        $user = Auth::user();
        $events = Event::whereUserId($user->id)->get();
        return view('user.events', compact('user', 'events'));
    }

    public function pastEvents()
    {
        $user = Auth::user();
        $events = Event::Join('reservations', 'events.id', '=', 'reservations.event_id')
                  ->where([['reservations.user_id', $user->id], ['permission', '2'], ['date', '<', Carbon::today()]])
                  ->get();
        return view('user.pastEvents', compact('user', 'events'));
    }

    public function reservedEvents()
    {
        $user = Auth::user();
        $reservations = Reservation::whereUserId($user->id)->get();
        return view('user.reservations', compact('user', 'reservations'));
    }

    public function favoriteEvents()
    {
        $user = Auth::user();
        $favorites = Favorite::whereUserId($user->id)->get();
        return view('user.favorites', compact('user', 'favorites'));
    }

    public function myFollowings()
    {
        $user = Auth::user();
        $followings = $user->following()->get();
        return view('user.following', compact('user', 'followings'));
    }

    public function myFollowers()
    {
        $user = Auth::user();
        $followers = $user->followed()->get();
        return view('user.follower', compact('user', 'followers'));
    }

    public function follow($username)
    {
        $user = User::whereUsername($username)->first();
        $follow = new Relationship();
        $follow->following_id = Auth::user()->id;
        $follow->followed_id = $user->id;
        $follow->save();
        return back();
    }

    public function unFollow($username)
    {
        $user = User::whereUsername($username)->first();
        $follow = Relationship::where('following_id', Auth::user()->id)
                  ->where('followed_id', $user->id)->first();
        $follow->delete();
        return back();
    }

    public function show($username)
    {
        if ($username == Auth::user()->username) {
            return redirect()->route('user.myPage');
        }
        $user = User::whereUsername($username)->first();
        $follow = Relationship::where([['following_id', Auth::user()->id], ['followed_id', $user->id]])->first();
        $followings = Relationship::where('following_id', $user->id)->get();
        $followers = Relationship::where('followed_id', $user->id)->get();
        return view('user.show', compact('user', 'follow', 'followings', 'followers'));
    }

    public function events($username)
    {
        $user = User::whereUsername($username)->first();
        $events = Event::whereUserId($user)->get();
        return view('user.events', compact('user', 'events'));
    }

    public function followings($username)
    {
        $user = User::whereUsername($username)->first();
        $followings = $user->following()->get();
        $follow = Relationship::where([['following_id', Auth::user()->id], ['followed_id', $user->id]])->first();
        return view('user.following', compact('user', 'followings', 'follow'));
    }

    public function followers($username)
    {
        $user = User::whereUsername($username)->first();
        $followers = $user->followed()->get();
        $follow = Relationship::where([['following_id', Auth::user()->id], ['followed_id', $user->id]])->first();
        return view('user.follower', compact('user', 'followers', 'follow'));
    }
}
