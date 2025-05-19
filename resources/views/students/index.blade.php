<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">
    <div class="max-w-6xl mx-auto py-10 px-4">
        <h1 class="text-4xl font-bold mb-6 text-center">List of Students</h1>

        @if(session()->has('success'))
            <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="mb-6 text-right">
            <form action="{{ route('students.create') }}" method="GET">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded shadow">
                    Add Student
                </button>
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300 rounded shadow">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-4 py-2 border">ID</th>
                        <th class="px-4 py-2 border">Name</th>
                        <th class="px-4 py-2 border">Username</th>
                        <th class="px-4 py-2 border">Email</th>
                        <th class="px-4 py-2 border">Phone</th>
                        <th class="px-4 py-2 border">Edit</th>
                        <th class="px-4 py-2 border">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($students as $student)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 border text-center">{{ $student->id }}</td>
                            <td class="px-4 py-2 border">{{ $student->full_name }}</td>
                            <td class="px-4 py-2 border">{{ $student->username }}</td>
                            <td class="px-4 py-2 border">{{ $student->email }}</td>
                            <td class="px-4 py-2 border">{{ $student->phone }}</td>
                            <td class="px-4 py-2 border text-center">
                                <form action="{{ route('students.edit', ['student' => $student]) }}" method="GET">
                                    <button type="submit" class="bg-yellow-400 hover:bg-yellow-500 text-white font-semibold py-1 px-3 rounded">
                                        Edit
                                    </button>
                                </form>
                            </td>
                            <td class="px-4 py-2 border text-center">
                                <form method="POST" action="{{ route('students.delete', ['student' => $student]) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-semibold py-1 px-3 rounded" onclick="return confirm('Are you sure?')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
