<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Post') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
            <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="text" name="title" placeholder="Title" class="w-full border p-2 mb-4 rounded">
                <textarea name="body" rows="4" placeholder="Write your story..." class="w-full border p-2 mb-4 rounded"></textarea>
                <input type="file" name="image" class="mb-4">

                <div class="flex justify-between">
                    <a href="{{ route('posts.index') }}" class="bg-red-500 text-white px-4 py-2 rounded">Back</a>
                    <button class="bg-blue-500 text-white px-4 py-2 rounded">Save Post</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
