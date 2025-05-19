<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Create New Student User</h1>
    <div>
        @if($errors->any())
            <ul>
                @foreach($errors->all() as $error)
                <li>{{$error}}</li>
                @endforeach
            </ul>
        @endif

    </div>
    <form method="post" action="{{route('students.store')}}">
        @csrf
        @method('post')
        <div>
            <label for="">First Name:</label>
        <input type="text" name="firstname" placeholder="John">
        </div>

        <div>
            <label for="">Last Name:</label>
        <input type="text" name="lastname" placeholder="Doe">
        </div>
        
        <div>
            <label for="">User Name:</label>
        <input type="text" name="username" placeholder="JDoe01">
        </div>
        
        <div>
            <label for="">Email:</label>
        <input type="email" name="email" placeholder="JDoe01@gmail.com">
        </div>
        
        <div>
            <label for="">Phone Number:</label>
        <input type="text" name="phone" placeholder="09123456789">
        </div>
        
        <div>
            <label for="">Password:</label>
        <input type="password" name="password" placeholder="John">
        </div>

        <div>
            <input type="submit" value="Save New Student"/>
        </div>
        
    </form>
</body>
</html>