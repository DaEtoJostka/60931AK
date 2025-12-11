@extends('layouts.app')

@section('title', $country->name)

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            <h2>{{ $country->name }}</h2>
        </div>
        <div class="card-body">
            <p><strong>Capital:</strong> {{ $country->capital }}</p>
            <p><strong>Population:</strong> {{ number_format($country->population) }}</p>
            <p><strong>Area:</strong> {{ number_format($country->area, 1) }} km²</p>
            <a href="{{ url('/countries') }}" class="btn btn-secondary">Back to List</a>
        </div>
    </div>

    <!-- 1:N Relationship: Events -->
    <h3>Events (1:N)</h3>
    @if($country->events->count() > 0)
        <table class="table table-bordered mb-4">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                @foreach($country->events as $event)
                    <tr>
                        <td>{{ $event->date }}</td>
                        <td>{{ $event->description }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="text-muted">No events recorded.</p>
    @endif

    <!-- 1:N Relationship: Economies -->
    <h3>Economy Stats (1:N)</h3>
    @if($country->economies->count() > 0)
        <table class="table table-bordered mb-4">
            <thead>
                <tr>
                    <th>Year</th>
                    <th>GDP (Billions)</th>
                    <th>GDP Per Capita</th>
                </tr>
            </thead>
            <tbody>
                @foreach($country->economies as $eco)
                    <tr>
                        <td>{{ $eco->year }}</td>
                        <td>{{ $eco->gdp }}</td>
                        <td>{{ $eco->gdp_per_capita }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="text-muted">No economy data recorded.</p>
    @endif

    <!-- M:N Relationship: Trade Partners -->
    <h3>Trade Partners (M:N)</h3>
    @if($country->partners->count() > 0)
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Partner Country</th>
                    <th>Year</th>
                    <th>Export Here -> Partner</th>
                    <th>Export Partner -> Here</th>
                </tr>
            </thead>
            <tbody>
                @foreach($country->partners as $partner)
                    <tr>
                        <td><a href="{{ url('/countries/' . $partner->id) }}">{{ $partner->name }}</a></td>
                        <td>{{ $partner->pivot->year }}</td>
                        <!-- Careful with direction of export based on pivot columns -->
                        <td>{{ $partner->pivot->export_c1_to_c2 }} / {{ $partner->pivot->export_c2_to_c1 }}</td>
                        <td>(See raw pivot data above)</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="text-muted">No trade partners recorded.</p>
    @endif
@endsection
