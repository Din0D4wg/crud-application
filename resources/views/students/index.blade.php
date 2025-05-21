<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session()->has('success'))
                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Add Student Button -->
            <div class="mb-6 text-right">
                <a href="{{ route('students.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded shadow">
                    Add Student
                </a>
            </div>

            <!-- All Students Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h2 class="text-2xl font-bold mb-4">List of Students</h2>
                    
                    @if(isset($students) && count($students) > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full border border-gray-300 rounded">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-2 border">ID</th>
                                        <th class="px-4 py-2 border">Name</th>
                                        <th class="px-4 py-2 border">Username</th>
                                        <th class="px-4 py-2 border">Email</th>
                                        <th class="px-4 py-2 border">Phone</th>
                                        <th class="px-4 py-2 border" colspan="2">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($students as $student)
                                        <tr class="hover:bg-blue-50">
                                            <td class="px-4 py-2 border text-center">{{ $student->id }}</td>
                                            <td class="px-4 py-2 border">{{ $student->full_name }}</td>
                                            <td class="px-4 py-2 border">{{ $student->username }}</td>
                                            <td class="px-4 py-2 border">{{ $student->email }}</td>
                                            <td class="px-4 py-2 border">{{ $student->phone }}</td>
                                            <td class="px-4 py-2 border text-center">
                                                <div class="flex mt-6 gap-4 justify-center">
                                                    <a href="{{ route('students.edit', $student->id) }}" class="bg-yellow-400 hover:bg-yellow-500 text-white font-semibold py-1 px-3 rounded">
                                                        Edit
                                                    </a>
                                                    <form method="POST" action="{{ route('students.delete', $student->id) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-semibold py-1 px-3 rounded" onclick="return confirm('Are you sure?')">
                                                            Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-gray-500 italic">No students in the system yet. Add your first student above!</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>