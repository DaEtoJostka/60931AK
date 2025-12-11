@extends('layouts.app')

@section('title', 'Events')

@section('content')
    <h1>Events List</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Date</th>
                <th>Country</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($events as $event)
                <tr>
                    <td>{{ $event->date }}</td>
                    <td>
                        @if($event->country)
                            <a href="{{ url('/countries/' . $event->country->id) }}">{{ $event->country->name }}</a>
                        @else
                            N/A
                        @endif
                    </td>
                    <td>{{ $event->description }}</td>
                    <td>
                        <a href="{{ url('/events/' . $event->id) }}" class="btn btn-primary btn-sm">View Details</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
