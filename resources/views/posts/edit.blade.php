<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Post') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8">
                    <h1 class="text-2xl font-bold mb-6">Edit Post</h1>

                    <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        @method('PUT')

                        <div>
                            <label for="title" class="block font-medium text-gray-700 mb-1">Title</label>
                            <input 
                                type="text" 
                                name="title" 
                                id="title"
                                value="{{ $post->title }}" 
                                class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-400"
                            >
                        </div>

                        <div>
                            <label for="body" class="block font-medium text-gray-700 mb-1">Body</label>
                            <textarea 
                                name="body" 
                                id="body" 
                                rows="6" 
                                class="w-full border border-gray-300 p-2 rounded resize-none focus:outline-none focus:ring-2 focus:ring-blue-400"
                            >{{ $post->body }}</textarea>
                        </div>

                        <div>
                            <label for="image" class="block font-medium text-gray-700 mb-1">Image (Optional)</label>
                            <input 
                                type="file" 
                                name="image" 
                                id="image"
                                class="block w-full text-sm text-gray-500
                                file:mr-4 file:py-2 file:px-4
                                file:rounded file:border-0
                                file:text-sm file:font-semibold
                                file:bg-blue-50 file:text-blue-700
                                hover:file:bg-blue-100" 
                            >
                        </div>

                        @if (method_exists($post, 'getFirstMediaUrl') && $post->getFirstMediaUrl('images'))
                            <div>
                                <p class="text-sm text-gray-600 mb-2">Current Image:</p>
                                <img src="{{ $post->getFirstMediaUrl('images') }}" class="max-w-md rounded border border-gray-200">
                            </div>
                        @endif

                        <div class="flex items-center justify-between pt-4">
                            <a href="{{ route('posts.index') }}" class="text-gray-600 hover:text-gray-800 hover:underline">
                                &larr; Back to Posts
                            </a>
                            <button 
                                type="submit" 
                                class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded shadow"
                            >
                                Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>