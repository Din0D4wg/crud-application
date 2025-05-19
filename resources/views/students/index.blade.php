<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>
</head>
<body>
    <h1 class="text-4xl">List of Students</h1>
    <div>
        @if(session()->has('success'))
        <div>
            {{session('success')}}
        </div>
            
        @endif
    </div>
    <div>
        <form action="{{ route('students.create') }}" method="GET">
            <input type="submit" value="Add Student">
        </form>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Username</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            @foreach($students as $student)
            <tr>
                <td>
                    {{$student->id}}
                </td>
                <td>
                    {{$student->full_name}}
                 </td>
                 <td>
                    {{$student->username}}
                </td>
                <td>
                    {{$student->email}}
                </td>
                <td>
                    {{$student->phone}}
                </td>
                <td>
                    <form action="{{ route('students.edit', ['student' => $student]) }}" method="GET" style="display: inline;">
                        <input type="submit" value="Edit">
                    </form>                </td>
                <td>
                    <form method="post" action="{{route('students.delete', ['student' => $student])}}">
                        @csrf
                        @method('delete')
                        <input type="submit" value="Delete"/>
                    </form>
                </td>
            </tr>
            
            @endforeach
        </table>
    </div>
</body>
</html>