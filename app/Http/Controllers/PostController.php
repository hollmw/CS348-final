<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        
        //$posts = Post::with(['user', 'comments.user'])->latest()->get();
        $posts = Post::all();
        return view('home', compact('posts'));
        
    }

    public function show(Post $post)
    {
        return view('post', compact('post'));
    }


    public function destroy(Post $post)
    {
        // Allow only the owner or an admin to delete the post
        if (auth()->user()->id !== $post->user_id && auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $post->delete();

        return redirect()->route('dashboard')->with('success', 'Post deleted successfully.');
    }
    public function edit(Post $post)
    {
        // Ensure only the owner can edit
        if (auth()->id() !== $post->user_id) {
            abort(403, 'Unauthorized action.');
        }

        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        // Ensure only the owner can update
        if (auth()->id() !== $post->user_id) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $post->update($validated);

        return redirect()->route('dashboard')->with('success', 'Post updated successfully.');
    }

}
