<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center font-sans text-gray-800">

    <div class="bg-white p-8 rounded shadow-md w-full max-w-xl">
        <h1 class="text-2xl font-bold mb-6 text-center">Edit Post</h1>

        <form action="/edit-post/{{$post->id}}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label for="title" class="block font-medium text-gray-700 mb-1">Title</label>
                <input 
                    type="text" 
                    name="title" 
                    id="title"
                    value="{{$post->title}}" 
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
                >{{$post->body}}</textarea>
            </div>

            <div class="text-center">
                <button 
                    type="submit" 
                    class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded shadow"
                >
                    Save Changes
                </button>
            </div>
        </form>
    </div>

</body>
</html>
