<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    // List all events
    public function index()
    {
        $events = Event::with('country')->get();
        return view('events.index', compact('events'));
    }

    // Show event details
    public function show($id)
    {
        $event = Event::with('country')->findOrFail($id);
        return view('events.show', compact('event'));
    }
}
