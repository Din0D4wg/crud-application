
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Student</title>
</head>
<body>
    <h1>Edit Student User Information</h1>
    
    <form method="post" action="{{route('students.update', $student)}}" autocomplete="off">
        @csrf
        @method('PUT')
        <div>
            <label for="firstname">First Name:</label>
            <input type="text" id="firstname" name="firstname" value="{{$student->firstname}}">
        </div>
        <div>
            <label for="lastname">Last Name:</label>
            <input type="text" id="lastname" name="lastname" value="{{$student->lastname}}">
        </div>
        <div>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" value="{{$student->username}}">
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{$student->email}}">
        </div>
        <div>
            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" value="{{$student->phone}}">
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" value="{{$student->password}}">
        </div>

        <div>
            <input type="submit" value="Update"/>
        </div>
        
    </form>
</body>
</html>