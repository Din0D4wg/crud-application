<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Student Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Create Post Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h2 class="text-2xl font-bold mb-4">Create a New Post</h2>
                    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        <input type="text" name="title" placeholder="Title" class="w-full border border-gray-300 p-2 rounded" />
                        <textarea name="body" rows="5" placeholder="Once upon a time..." class="w-full border border-gray-300 p-2 rounded"></textarea>
                        <input type="file" name="image" class="block w-full text-sm text-gray-500
                            file:mr-4 file:py-2 file:px-4
                            file:rounded file:border-0
                            file:text-sm file:font-semibold
                            file:bg-blue-50 file:text-blue-700
                            hover:file:bg-blue-100" />
                        <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                            Save Post
                        </button>
                    </form>
                </div>
            </div>

            <!-- All Posts Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h2 class="text-2xl font-bold mb-4">All Posts</h2>
                    @if(isset($posts) && count($posts) > 0)
                        @foreach($posts as $post)
                            <div class="bg-blue-50 p-4 rounded mb-4 border border-blue-100">
                                <h3 class="text-xl font-semibold">{{ $post->title }} 
                                    <span class="text-sm text-gray-600">by {{ $post->user->name }}</span>
                                </h3>
                                <p class="my-2">{{ $post->body }}</p>
                                @if (method_exists($post, 'getFirstMediaUrl') && $post->getFirstMediaUrl('images'))
                                    <img src="{{ $post->getFirstMediaUrl('images') }}" class="max-w-md my-2 rounded">
                                @endif
                                <div class="flex items-center justify-end mt-2 space-x-3">
                                    <a href="{{ route('posts.edit', $post->id) }}" class="text-blue-700 hover:underline">Edit</a>
                                    <form action="{{ route('posts.delete', $post->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="text-gray-500 italic">No posts yet. Create your first post above!</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>