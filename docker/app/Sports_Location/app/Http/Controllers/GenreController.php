<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genre;
use App\Models\Event;
use App\Models\Area;

class GenreController extends Controller
{
    public function show($genre_id)
    {
        $genres = Genre::all();
        $areas = Area::all();
        $events = Event::where('genre_id', $genre_id)->latest()->paginate(10);
        return view('event/index', compact('genres', 'areas', 'events', 'genre_id'));
    }
}
