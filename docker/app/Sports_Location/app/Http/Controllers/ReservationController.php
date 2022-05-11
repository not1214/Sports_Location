<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Event;
use App\Models\Reservation;

class ReservationController extends Controller
{
    public function index(Event $event)
    {
        $reservations = Reservation::all();

        return view('reservation/index', compact('reservations', 'event'));
    }

    public function create(Event $event)
    {
        return view('reservation/create', compact('event'));
    }

    public function store(Request $request, Event $event)
    {
        $reservation = new Reservation();
        $reservation->user_id = Auth::user()->id;
        $reservation->event_id = $event->id;
        $reservation->comment = $request->comment;
        $reservation->save();

        return redirect()->route('user.reservedEvents');
    }

    public function edit(Event $event, $id)
    {
        $reservation = Reservation::findOrFail($id);
        return view('reservation/edit', compact('reservation', 'event'));
    }

    public function update(Request $request, $id)
    {
        $reservation = Reservation::findOrFail($id);

        $reservation->permission = $request->permission;
        $reservation->reply = $request->reply;
        $reservation->save();

        return redirect()->route('events.reservation.index', ['event' => $reservation->event_id]);
    }

    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();

        return redirect()->route('user.reservedEvents');
    }
}
