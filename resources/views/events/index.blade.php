<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Events</title>
</head>
<body>
<h2>Events List</h2>
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
                <a href="{{ url('/events/' . $event->id) }}">View Details</a>
            </td>
        </tr>
    @endforeach
</table>
</body>
</html>
