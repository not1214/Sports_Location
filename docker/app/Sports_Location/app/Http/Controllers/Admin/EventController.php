<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Genre;
use App\Models\Area;


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

    public function show()
    {
        
    }

    public function edit()
    {
        
    }

    public function update()
    {
        
    }
}
