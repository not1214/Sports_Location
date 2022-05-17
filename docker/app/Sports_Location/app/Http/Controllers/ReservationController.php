<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Http\Requests\CreateReservation;
use App\Models\Event;
use App\Models\Reservation;

class ReservationController extends Controller
{
    public function index(Event $event)
    {
        if ($event->user_id != Auth::user()->id) {
            return redirect()->route('events.show', ['event' => $event->id]);
        }

        $reservations = Reservation::where('event_id', $event->id)->get();
        return view('reservation/index', compact('reservations', 'event'));
    }

    public function create(Event $event)
    {
        if ($event->user_id == Auth::user()->id || $event->deadline < Carbon::now()) {
            return redirect()->route('events.show', ['event' => $event->id]);
        }
        return view('reservation/create', compact('event'));
    }

    public function store(CreateReservation $request, Event $event)
    {
        if ($event->user_id == Auth::user()->id) {
            return redirect()->route('events.show', ['event' => $event->id]);
        }

        $reservation = new Reservation();
        $reservation->user_id = Auth::user()->id;
        $reservation->event_id = $event->id;
        $reservation->comment = $request->comment;
        $reservation->save();

        return redirect()->route('user.reservedEvents');
    }

    public function show(Event $event, $id)
    {
        if ($event->user_id == Auth::user()->id) {
            return redirect()->route('events.reservations.index', ['event' => $event->id]);
        }

        $reservation = Reservation::findOrFail($id);
        return view('reservation/show', compact('reservation', 'event'));
    }

    public function edit(Event $event, $id)
    {
        if ($event->user_id != Auth::user()->id) {
            return redirect()->route('events.show', ['event' => $event->id]);
        }

        $reservation = Reservation::findOrFail($id);
        return view('reservation/edit', compact('reservation', 'event'));
    }

    public function update(CreateReservation $event, Request $request, $id)
    {
        if ($event->user_id != Auth::user()->id) {
            return redirect()->route('events.show', ['event' => $event->id]);
        }

        $reservation = Reservation::find($id);

        $reservation->permission = $request->permission;
        $reservation->reply = $request->reply;
        $reservation->save();

        return redirect()->route('events.reservations.index', ['event' => $reservation->event_id]);
    }

    public function destroy(Event $event, $id)
    {
        if ($event->user_id == Auth::user()->id) {
            return redirect()->route('events.reservations.index', ['event' => $event->id]);
        }

        $reservation = Reservation::findOrFail($id);
        $reservation->delete();

        return redirect()->route('user.reservedEvents');
    }
}
