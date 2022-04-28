<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;
use App\Models\Event;
use App\Models\Area;
use App\Models\User;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::all();
        return view('event/index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $event = new Event();
        $areas = Area::all();
        return view('event/create', compact('event', 'areas'));
    }

    public function confirm(Request $request)
    {
        $event = $request->except('image');
        $event_image = $request->file('image');

        $temp_path = $event_image->store('public/temp');
        $read_temp_path = str_replace('public/', 'storage/', $temp_path);

        $event['temp_path'] = $temp_path;
        $event['read_temp_path'] = $read_temp_path;
        $event['user'] = Auth::user()->username;
        $request->session()->put('event', $event);
        $area = Area::find($event['area']);

        return view('event/create_confirm', compact('event', 'area'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->get('back')) {
            return redirect('/events/create')->withInput();
        }

        $data = $request->session()->get('event');
        $temp_path = $data['temp_path'];
        $read_temp_path = $data['read_temp_path'];

        $filename = str_replace('public/temp/', '', $temp_path);
        $storage_path = 'public/event/'.$filename;

        $request->session()->forget('event');

        Storage::move($temp_path, $storage_path);

        $read_path = str_replace('public/', 'storage/', $storage_path);

        $event = new Event;
        $event->title = $data['title'];
        $event->event_image = $read_path;
        $event->user_id = User::whereUsername($data['user'])->first()->id;
        $event->area_id = $data['area'];
        $event->location = $data['location'];
        $event->date = $data['date'];
        $event->start_time = $data['start_time'];
        $event->end_time = $data['end_time'];
        $event->contents = $data['contents'];
        $event->condition = $data['condition'];
        $event->deadline = strtotime($data['deadline']);
        $event->number = $data['number'];
        $event->stuff = $data['stuff'];
        $event->attention = $data['attention'];
        $event->status = $data['status'];

        $event->save();
        return redirect()->route('events.show', [$event->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = Event::findOrFail($id);
        return view('event/show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = Event::findOrFail($id);
        $areas = Area::all();
        return view('event/edit', compact('event', 'areas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
