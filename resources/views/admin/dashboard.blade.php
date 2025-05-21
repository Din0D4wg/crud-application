<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @if(auth()->user() && auth()->user()->role === 'admin')
    <a href="{{ route('students.index') }}">Go to Admin Dashboard</a>
    @endif
</head>
<body>
    <h1>Admin Dashboard</h1>
</body>
</html>