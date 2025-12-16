<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Event</title>
</head>
<body>
<h2>Create Event</h2>

@if ($errors->any())
    <div style="color: red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ url('/events') }}" method="POST">
    @csrf
    <div>
        <label>Country:</label>
        <select name="country_id">
            <option value="">Select Country</option>
            @foreach($countries as $country)
                <option value="{{ $country->id }}" {{ old('country_id') == $country->id ? 'selected' : '' }}>
                    {{ $country->name }}
                </option>
            @endforeach
        </select>
    </div>
    <br>
    <div>
        <label>Description:</label>
        <textarea name="description">{{ old('description') }}</textarea>
    </div>
    <br>
    <div>
        <label>Date:</label>
        <input type="date" name="date" value="{{ old('date') }}">
    </div>
    <br>
    <button type="submit">Create</button>
</form>

<a href="{{ url('/events') }}">Back to List</a>
</body>
</html>
