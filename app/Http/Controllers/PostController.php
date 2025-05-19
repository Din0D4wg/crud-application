<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function DeletePost(Post $post)
    {
        $user = Auth::user();
        if ($user->role !== 'admin' && $user->id === $post->user_id) {
            $post->clearMediaCollection('images');
            $post->delete();
        }
        return redirect('/');
    }

    public function SaveEditedPost(Post $post, Request $request)
    {
        $user = Auth::user();
        if ($user->role === 'admin' || $user->id !== $post->user_id) {
            return redirect('/');
        }

        $newpost = $request->validate([
            'title' => 'required',
            'body' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $newpost['title'] = strip_tags($newpost['title']);
        $newpost['body'] = strip_tags($newpost['body']);  

        $post->update($newpost);

        if ($request->hasFile('image')) {
            $post->clearMediaCollection('images');
            $post->addMediaFromRequest('image')->toMediaCollection('images');
        }

        return redirect('/');
    }

    public function EditPostHere(Post $post)
    {
        $user = Auth::user();
        if ($user->role === 'admin' || $user->id !== $post->user_id) {
            return redirect('/');
        }

        return view('edit-post', ['post' => $post]);
    }
}