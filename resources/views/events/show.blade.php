<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Event Details</title>
</head>
<body>
<h2>Event Details</h2>
<p><strong>Description:</strong> {{ $event->description }}</p>
<p><strong>Date:</strong> {{ $event->date }}</p>
<p><strong>Country:</strong> 
    @if($event->country)
        <a href="{{ url('/countries/' . $event->country->id) }}">{{ $event->country->name }}</a>
    @else
        N/A
    @endif
</p>
<a href="{{ url('/events') }}">Back to Events</a>
</body>
</html>
