<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Genre;
use App\Models\Event;
use App\Models\Area;

class GenreController extends Controller
{
    public function index()
    {
        $genres = Genre::all();
        return view('admin/genre/index', compact('genres'));
    }

    public function show($genre_id)
    {
        $genres = Genre::all();
        $areas = Area::all();
        $events = Event::where('genre_id', $genre_id)->latest()->paginate(10);
        return view('admin/event/index', compact('genres', 'areas', 'events', 'genre_id'));
    }

    public function store(Request $request)
    {
        $genre = new Genre;
        $genre->genre_name = $request->name;
        $genre->save();

        return redirect()->route('admin.genres.index');
    }

    public function edit($id)
    {
        $genre = Genre::findOrFail($id);
        return view('admin.genre.edit', compact('genre'));
    }

    public function update(Request $request, $id)
    {
        $genre = Genre::findOrFail($id);
        $genre->genre_name = $request->name;
        $genre->save();

        return redirect()->route('admin.genres.index');
    }
}
