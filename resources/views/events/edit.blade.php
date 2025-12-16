<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Event</title>
</head>
<body>
<h2>Edit Event</h2>

@if ($errors->any())
    <div style="color: red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ url('/events/' . $event->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div>
        <label>Country:</label>
        <select name="country_id">
            <option value="">Select Country</option>
            @foreach($countries as $country)
                <option value="{{ $country->id }}" {{ (old('country_id', $event->country_id) == $country->id) ? 'selected' : '' }}>
                    {{ $country->name }}
                </option>
            @endforeach
        </select>
    </div>
    <br>
    <div>
        <label>Description:</label>
        <textarea name="description">{{ old('description', $event->description) }}</textarea>
    </div>
    <br>
    <div>
        <label>Date:</label>
        <input type="date" name="date" value="{{ old('date', $event->date) }}">
    </div>
    <br>
    <button type="submit">Update</button>
</form>

<a href="{{ url('/events') }}">Back to List</a>
</body>
</html>
