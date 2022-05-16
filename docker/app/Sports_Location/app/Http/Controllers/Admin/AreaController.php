<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Genre;
use App\Models\Area;
use App\Models\Event;

class AreaController extends Controller
{
    public function show($area_id)
    {
        $genres = Genre::all();
        $areas = Area::all();
        $events = Event::where('area_id', $area_id)->latest()->get();
        return view('admin/event/index', compact('genres', 'areas', 'events', 'area_id'));
    }
}
