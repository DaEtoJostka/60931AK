<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $country->name }}</title>
</head>
<body>
<h2>{{ $country->name }}</h2>
<p><strong>Capital:</strong> {{ $country->capital }}</p>
<p><strong>Population:</strong> {{ number_format($country->population) }}</p>
<p><strong>Area:</strong> {{ number_format($country->area, 1) }} km²</p>
<a href="{{ url('/countries') }}">Back to List</a>

<!-- 1:N Relationship: Events -->
<h3>Events (1:N)</h3>
@if($country->events->count() > 0)
    <table border="1">
        <thead>
            <td>Date</td>
            <td>Description</td>
        </thead>
        @foreach($country->events as $event)
            <tr>
                <td>{{ $event->date }}</td>
                <td>{{ $event->description }}</td>
            </tr>
        @endforeach
    </table>
@else
    <p>No events recorded.</p>
@endif

<!-- 1:N Relationship: Economies -->
<h3>Economy Stats (1:N)</h3>
@if($country->economies->count() > 0)
    <table border="1">
        <thead>
            <td>Year</td>
            <td>GDP (Billions)</td>
            <td>GDP Per Capita</td>
        </thead>
        @foreach($country->economies as $eco)
            <tr>
                <td>{{ $eco->year }}</td>
                <td>{{ $eco->gdp }}</td>
                <td>{{ $eco->gdp_per_capita }}</td>
            </tr>
        @endforeach
    </table>
@else
    <p>No economy data recorded.</p>
@endif

<!-- M:N Relationship: Trade Partners -->
<h3>Trade Partners (M:N)</h3>
@if($country->partners->count() > 0)
    <table border="1">
        <thead>
            <td>Partner Country</td>
            <td>Year</td>
            <td>Export Here -> Partner</td>
            <td>Export Partner -> Here</td>
        </thead>
        @foreach($country->partners as $partner)
            <tr>
                <td><a href="{{ url('/countries/' . $partner->id) }}">{{ $partner->name }}</a></td>
                <td>{{ $partner->pivot->year }}</td>
                <td>{{ $partner->pivot->export_c1_to_c2 }} / {{ $partner->pivot->export_c2_to_c1 }}</td>
                <td>(See raw pivot data above)</td>
            </tr>
        @endforeach
    </table>
@else
    <p>No trade partners recorded.</p>
@endif

</body>
</html>
