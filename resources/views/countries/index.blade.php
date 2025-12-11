@extends('layouts.app')

@section('title', 'Countries')

@section('content')
    <h1>Countries List</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Capital</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($countries as $country)
                <tr>
                    <td>{{ $country->id }}</td>
                    <td>{{ $country->name }}</td>
                    <td>{{ $country->capital }}</td>
                    <td>
                        <a href="{{ url('/countries/' . $country->id) }}" class="btn btn-primary btn-sm">View Details</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
