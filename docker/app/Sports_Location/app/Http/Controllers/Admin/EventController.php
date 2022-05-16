<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Event;
use App\Models\Genre;
use App\Models\Area;
use App\Models\User;
use App\Models\Favorite;


class EventController extends Controller
{
    public function index(Request $request)
    {
        $genre_id = $request->genre;
        $area_id = $request->area;
        $keyword = $request->keyword;
        $query = Event::query();

        if (!empty($genre_id)) {
            $query->where('genre_id', $genre_id);
        }
        if (!empty($area_id)) {
            $query->where('area_id', $area_id);
        }
        if (!empty($keyword)) {
            $query->where('title', 'like', '%'. $keyword. '%');
        }

        $events = $query->latest()->get();
        $genres = Genre::all();
        $areas = Area::all();
        return view('admin/event/index', compact('events', 'genres', 'areas', 'genre_id', 'area_id', 'keyword'));
    }

    public function show($id)
    {
        $event = Event::findOrFail($id);
        return view('admin/event/show', compact('event'));
    }

    public function edit($id)
    {
        $event = Event::findOrFail($id);
        if ($event->date < Carbon::today()) {
            return redirect()->route('events.show', ['event'=>$event->id]);
        }
        $areas = Area::all();
        $genres = Genre::all();
        return view('admin/event/edit', compact('event', 'areas', 'genres'));
    }

    public function confirm(Request $request, Event $event)
    {
        $data = $request->except('image');

        if (!empty($request->image)) {
            $temp_path = $request->file('image')->store('public/temp');
            $read_temp_path = str_replace('public/', 'storage/', $temp_path);
            $data['temp_path'] = $temp_path;
            $data['read_temp_path'] = $read_temp_path;
        } else {
            $data['read_temp_path'] = $event->event_image;
        }

        $data['user'] = $event->user->username;
        $request->session()->put('data', $data);
        $area = Area::find($data['area']);
        $genre = Genre::find($data['genre']);

        return view('admin/event/confirm', compact('data', 'area', 'genre', 'event'));
    }

    public function update(Request $request, $id)
    {
        if ($request->get('back')) {
            return redirect()->route('admin.events.edit', ['event' => $id])->withInput();
        }

        $event = Event::findOrFail($id);
        $data = $request->session()->get('data');

        if (!empty($data['temp_path'])) {
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
        return redirect()->route('admin.events.show', ['event' => $id]);
    }
}
