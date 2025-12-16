<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\Gate;

class EventController extends Controller
{

    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 5);
        $events = Event::with('country')->paginate($perPage)->appends(['per_page' => $perPage]);
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
        if (! Gate::allows('edit-event')) {
            abort(403, 'You are not authorized to edit events.');
        }

        $event = Event::findOrFail($id);
        $countries = \App\Models\Country::all();
        return view('events.edit', compact('event', 'countries'));
    }

    public function update(Request $request, $id)
    {
        if (! Gate::allows('edit-event')) {
            abort(403, 'You are not authorized to update events.');
        }

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
        if (! Gate::allows('delete-event')) {
            abort(403, 'You are not authorized to delete events.');
        }

        $event = Event::findOrFail($id);
        $event->delete();
        return redirect('/events');
    }
}
