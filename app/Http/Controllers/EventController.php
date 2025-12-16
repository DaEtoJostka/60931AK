<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{

    public function index()
    {
        $events = Event::with('country')->get();
        return view('events.index', compact('events'));
    }

    public function create()
    {
        $countries = \App\Models\Country::all();
        return view('events.create', compact('countries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'country_id' => 'required|exists:countries,id',
            'description' => 'required',
            'date' => 'nullable|date',
        ]);

        $event = new Event();
        $event->country_id = $request->country_id;
        $event->description = $request->description;
        $event->date = $request->date;
        $event->save();

        return redirect('/events');
    }

    public function show($id)
    {
        $event = Event::with('country')->findOrFail($id);
        return view('events.show', compact('event'));
    }

    public function edit($id)
    {
        $event = Event::findOrFail($id);
        $countries = \App\Models\Country::all();
        return view('events.edit', compact('event', 'countries'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'country_id' => 'required|exists:countries,id',
            'description' => 'required',
            'date' => 'nullable|date',
        ]);

        $event = Event::findOrFail($id);
        $event->country_id = $request->country_id;
        $event->description = $request->description;
        $event->date = $request->date;
        $event->save();

        return redirect('/events');
    }

    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();
        return redirect('/events');
    }
}
