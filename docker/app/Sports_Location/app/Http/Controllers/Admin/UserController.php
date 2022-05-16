<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
    public function index()
    {
        $users = User::all();
        return view('admin.user.index', compact('users'));
    }

    public function show($username)
    {
        $user = User::where('username', $username)->firstOrFail();
        $followings = Relationship::where('following_id', $user->id)->get();
        $followers = Relationship::where('followed_id', $user->id)->get();
        return view('admin.user.show', compact('user', 'followings', 'followers'));
    }

    public function edit($username)
    {
        $user = User::where('username', $username)->firstOrFail();
        return view('admin.user.edit', compact('user'));
    }

    public function update($username, Request $request)
    {
        $user = User::where('username', $username)->firstOrFail();
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
        return redirect()->route('admin.user.show', ['username' => $user->username]);
    }

    public function followings($username)
    {
        $user = User::where('username', $username)->firstOrFail();
        $followings = $user->following()->get();
        return view('admin.user.following', compact('user', 'followings'));
    }

    public function followers($username)
    {
        $user = User::where('username', $username)->firstOrFail();
        $followers = $user->followed()->get();
        return view('admin.user.follower', compact('user', 'followers'));
    }

    public function createdEvents($username)
    {
        $user = User::where('username', $username)->firstOrFail();
        $events = Event::whereUserId($user->id)->get();
        return view('admin.user.events', compact('user', 'events'));
    }

    public function pastEvents($username)
    {
        $user = User::where('username', $username)->firstOrFail();
        $events = Event::Join('reservations', 'events.id', '=', 'reservations.event_id')
                  ->where([['reservations.user_id', $user->id], ['permission', '2'], ['date', '<', Carbon::today()]])
                  ->get();
        return view('admin.user.pastEvents', compact('user', 'events'));
    }

    public function unsubscribe($username)
    {
        return view('admin.user.unsubscribe', compact('username'));
    }

    public function withdraw($username)
    {
        $user = User::where('username', $username)->firstOrFail();
        $user->delete();
        Auth::logout();
        return redirect('/');
    }
}
