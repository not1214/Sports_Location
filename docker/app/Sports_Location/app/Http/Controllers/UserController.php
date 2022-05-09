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

class UserController extends Controller
{
    public function myPage()
    {
        $user = Auth::user();
        return view('user/myPage', compact('user'));
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
            $image = $request->file('profile_image');
            $path = $image->store('storage/user');
            $user->profile_image = $path;
        }

        $user->save();
        return redirect()->route('user.myPage');
    }

    public function unsubscribe()
    {
        return view('user/unsubscribe');
    }

    public function withdraw(User $user)
    {
        // $user = Auth::user();
        $user->delete();
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
        $events = DB::table('events')->join('reservations', function ($join) {
                      $join->on('events.id', '=', 'reservations.event_id')
                      ->where([['user_id', '$user->id'], ['permission', '2'], ['date', '>', Carbon::today()]])
                      ->get();
        });
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

    }

    public function myFollowers()
    {

    }

    public function follow()
    {

    }

    public function unFollow()
    {

    }

    public function show($username)
    {
        if ($username == Auth::user()->username) {
            return redirect()->route('user.myPage');
        }
        $user = User::whereUsername($username)->first();
        return view('user.show', compact('user'));
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
    }

    public function followers($username)
    {
        $user = User::whereUsername($username)->first();
    }
}
