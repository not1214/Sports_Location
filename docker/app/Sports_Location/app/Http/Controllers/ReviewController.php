<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Event;
use App\Models\Area;
use App\Models\Genre;
use App\Models\User;
use App\Models\Review;

class ReviewController extends Controller
{
    public function index(Event $event)
    {
        $reviews = Review::latest()->paginate(10);
        $joined_event = DB::table('events')->join('reservations', 'events.id', '=', 'reservations.event_id')
                        ->where([['reservations.user_id', Auth::user()->id], ['permission', '2'], ['event_id', '=', $event->id]])
                        ->first();
        $review_check = Review::where([['user_id', Auth::user()->id], ['event_id', $event->id]])->first();
        return view('review/index', compact('reviews', 'event', 'joined_event', 'review_check'));
    }

    public function create(Event $event)
    {
        if ($event->user_id == Auth::user()->id) {
            return redirect()->route('events.reviews.index', ['event' => $event->id]);
        }
        $joined_event = DB::table('events')->join('reservations', 'events.id', '=', 'reservations.event_id')
                        ->where([['reservations.user_id', Auth::user()->id], ['permission', '2'], ['event_id', '=', $event->id]])
                        ->first();
        if (empty($joined_event)) {
            return redirect()->route('events.reviews.index', ['event' => $event->id]);
        }
        $review = new Review();
        return view('review/create', compact('event', 'review', 'joined_event'));
    }

    public function store(Event $event, Request $request)
    {
        if ($event->user_id == Auth::user()->id) {
            return redirect()->route('events.reviews.index', ['event' => $event->id]);
        }
        $joined_event  = DB::table('events')->join('reservations', 'events.id', '=', 'reservations.event_id')
                         ->where([['reservations.user_id', Auth::user()->id], ['permission', '2'], ['event_id', '=', $event->id]])
                         ->first();
        if (empty($joined_event)) {
            return redirect()->route('events.reviews.index', ['event' => $event->id]);
        }

        $review = new Review();
        $review->event_id = $event->id;
        $review->user_id = Auth::user()->id;
        $review->score = $request->score;
        $review->comment = $request->comment;
        $review->save();

        return redirect()->route('events.reviews.index', ['event' => $event->id]);
    }

    public function edit(Event $event, Review $review)
    {
        if ($review->user_id != Auth::user()->id) {
            return redirect()->route('events.reviews.index');
        }

        $review = Review::findOrFail($review->id);
        return view('review/edit', compact('event', 'review'));
    }

    public function update(Event $event, Review $review, Request $request)
    {
        if ($review->user_id != Auth::user()->id) {
            return redirect()->route('events.reviews.index', ['event' => $event->id]);
        }

        $review = Review::findOrFail($review->id);
        $review->score = $request->score;
        $review->comment = $request->comment;
        $review->save();

        return redirect()->route('events.reviews.index', ['event' => $event->id]);
    }

    public function destroy(Event $event, Review $review)
    {
        if ($review->user_id != Auth::user()->id) {
            return redirect()->route('events.reviews.index', ['event' => $event->id]);
        }

        $review = Review::findOrFail($review->id);
        $review->delete();

        return redirect()->route('events.reviews.index', ['event' => $event->id]);
    }
}
