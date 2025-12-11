@extends('layouts.app')

@section('title', 'Event Details')

@section('content')
    <div class="card">
        <div class="card-header">
            <h2>Event Details</h2>
        </div>
        <div class="card-body">
            <p><strong>Description:</strong> {{ $event->description }}</p>
            <p><strong>Date:</strong> {{ $event->date }}</p>
            <p><strong>Country:</strong> 
                @if($event->country)
                    <a href="{{ url('/countries/' . $event->country->id) }}">{{ $event->country->name }}</a>
                @else
                    N/A
                @endif
            </p>
            <a href="{{ url('/events') }}" class="btn btn-secondary">Back to Events</a>
        </div>
    </div>
@endsection
