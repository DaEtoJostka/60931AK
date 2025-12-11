<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Countries</title>
</head>
<body>
<h2>Countries List</h2>
<table border="1">
    <thead>
        <td>ID</td>
        <td>Name</td>
        <td>Capital</td>
        <td>Actions</td>
    </thead>
    @foreach($countries as $country)
        <tr>
            <td>{{ $country->id }}</td>
            <td>{{ $country->name }}</td>
            <td>{{ $country->capital }}</td>
            <td>
                <a href="{{ url('/countries/' . $country->id) }}">View Details</a>
            </td>
        </tr>
    @endforeach
</table>
</body>
</html>
