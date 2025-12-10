<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>609-31</title>
</head>
<body>
    <h1>Hello from Blade!</h1>
    <p>Received data:</p>
    <ul>
        @foreach($data as $item)
            <li>{{ $item }}</li>
        @endforeach
    </ul>
</body>
</html>
