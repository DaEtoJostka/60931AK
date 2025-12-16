<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Events</title>
</head>
<body>
<h2>Events List</h2>
<a href="{{ url('/events/create') }}">Create Event</a>
<table border="1">
    <thead>
        <td>Date</td>
        <td>Country</td>
        <td>Description</td>
        <td>Actions</td>
    </thead>
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
                <a href="{{ url('/events/' . $event->id) }}">View</a>
                <a href="{{ url('/events/' . $event->id . '/edit') }}">Edit</a>
                <form action="{{ url('/events/' . $event->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            </td>
        </tr>
    @endforeach
</table>
</body>
</html>
