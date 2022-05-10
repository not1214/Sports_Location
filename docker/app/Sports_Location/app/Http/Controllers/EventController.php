<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;
use App\Models\Event;
use App\Models\Area;
use App\Models\Genre;
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
        $genres = Genre::all();
        return view('event/index', compact('events', 'genres'));
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
        $genres = Genre::all();
        return view('event/create', compact('event', 'areas', 'genres'));
    }

    public function createConfirm(Request $request)
    {
        $data = $request->except('image');

        if ($request->hasFile('image')) {
            $temp_path = $request->file('image')->store('public/temp');
            $read_temp_path = str_replace('public/', 'storage/', $temp_path);
            $data['temp_path'] = $temp_path;
            $data['read_temp_path'] = $read_temp_path;
        }

        $data['user'] = Auth::user()->username;
        $request->session()->put('data', $data);
        $area = Area::find($data['area']);
        $genre = Genre::find($data['genre']);

        return view('event/create_confirm', compact('data', 'area', 'genre'));
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

        $event = new Event;
        $data = $request->session()->get('data');
        if (!empty($request->image)) {
            $temp_path = $data['temp_path'];
            $filename = str_replace('public/temp/', '', $temp_path);
            $storage_path = 'public/event/'.$filename;

            Storage::move($temp_path, $storage_path);

            $read_path = str_replace('public/', 'storage/', $storage_path);
            $event->event_image = $read_path;
        }
        $request->session()->forget('data');

        $event->title = $data['title'];
        $event->user_id = Auth::user()->id;
        $event->area_id = $data['area'];
        $event->genre_id = $data['genre'];
        $event->location = $data['location'];
        $event->date = $data['date'];
        $event->start_time = $data['start_time'];
        $event->end_time = $data['end_time'];
        $event->contents = $data['contents'];
        $event->condition = $data['condition'];
        $event->deadline = $data['deadline'];
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
        $genres = Genre::all();
        return view('event/edit', compact('event', 'areas', 'genres'));
    }

    public function editConfirm(Request $request, Event $event)
    {
        $data = $request->except('image');

        if ($request->hasFile('image')) {
            $temp_path = $request->file('image')->store('public/temp');
            $read_temp_path = str_replace('public/', 'storage/', $temp_path);
            $data['temp_path'] = $temp_path;
            $data['read_temp_path'] = $read_temp_path;
        } else {
            $data['read_temp_path'] = $event->event_image;
        }

        $data['user'] = Auth::user()->username;
        $request->session()->put('data', $data);
        $area = Area::find($data['area']);
        $genre = Genre::find($data['genre']);

        return view('event/edit_confirm', compact('data', 'area', 'genre', 'event'));
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
        if ($request->get('back')) {
            return redirect()->route('events.edit', ['event' => $id])->withInput();
        }

        $event = Event::findOrFail($id);
        $data = $request->session()->get('data');

        if (!empty($request->image)) {
            $temp_path = $data['temp_path'];
            $filename = str_replace('public/temp/', '', $temp_path);
            $storage_path = 'public/event/'.$filename;

            Storage::delete($event->event_image);

            $request->session()->forget('data');

            Storage::move($temp_path, $storage_path);

            $read_path = str_replace('public/', 'storage/', $storage_path);
            $event->event_image = $read_path;
        }

        $event->title = $request->title;
        $event->user_id = User::whereUsername($data['user'])->first()->id;
        $event->area_id = $data['area'];
        $event->genre_id = $data['genre'];
        $event->location = $data['location'];
        $event->date = $data['date'];
        $event->start_time = $data['start_time'];
        $event->end_time = $data['end_time'];
        $event->contents = $data['contents'];
        $event->condition = $data['condition'];
        $event->deadline = $data['deadline'];
        $event->number = $data['number'];
        $event->stuff = $data['stuff'];
        $event->attention = $data['attention'];
        $event->status = $data['status'];

        $event->save();
        return redirect()->route('events.show', [$event->id]);
    }
}
