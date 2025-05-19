<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Post</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-800 font-sans">

<div class="max-w-prose mx-auto p-6">
    @auth
        <div class="text-right mb-6">
            <p class="text-green-700 font-semibold mb-2">Congrats, you are logged in!</p>
            <form action="/logout" method="POST" class="inline-block">
                @csrf
                <button class="bg-red-500 hover:bg-red-600 text-white font-medium px-4 py-2 rounded">
                    Log Out
                </button>
            </form>
        </div>

        <div class="bg-white p-6 rounded-lg shadow mb-8">
            <h2 class="text-2xl font-bold mb-4">Create a New Post</h2>
            <form action="/create-post" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <input type="text" name="title" placeholder="Title" class="w-full border border-gray-300 p-2 rounded" />
                <textarea name="body" rows="5" placeholder="Once upon a time..." class="w-full border border-gray-300 p-2 rounded"></textarea>
                <input type="file" name="image" />
                <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                    Save Post
                </button>
            </form>
        </div>

        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-2xl font-bold mb-4">All Posts</h2>
            @foreach($posts as $post)
                <div class="bg-blue-100 p-4 rounded mb-4">
                    <h3 class="text-xl font-semibold">{{ $post['title'] }} <span class="text-sm text-gray-600">by {{ $post->user->name }}</span></h3>
                    <p class="my-2">{{ $post['body'] }}</p>
                    @if ($post->getFirstMediaUrl('images'))
                        <img src="{{ $post->getFirstMediaUrl('images') }}" style="max-width: 400px;">
                    @endif
                    <div class="flex items-center justify-between mt-2">
                        <a href="/edit-post/{{ $post->id }}" class="text-blue-700 hover:underline ml-3">Edit</a>
                        <form action="/delete-post/{{ $post->id }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @endauth
</div>

</body>
</html>
