<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Posts') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-end mb-4">
                <a href="{{ route('posts.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    + Create New Post
                </a>
            </div>

            @foreach($posts as $post)
                <div class="bg-white p-4 rounded shadow mb-6">
                    <h3 class="text-xl font-semibold">{{ $post->title }}</h3>
                    <p class="text-sm text-gray-500 mb-2">Posted by {{ $post->user->name }}</p>

                    <p class="text-gray-700">{{ $post->body }}</p>

                    @if($post->getFirstMediaUrl('images'))
                        <img src="{{ $post->getFirstMediaUrl('images') }}" class="mt-4 max-w-md rounded border border-gray-200">
                    @endif
                    

                    <div class="flex justify-end mt-6 gap-4 items-center">
                        <a href="{{ route('posts.edit', $post->id) }}" class="text-blue-700 hover:underline">Edit</a>
                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Delete</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
