<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;


class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required|string|max:255',
        ]);

        $post->comments()->create([
            'content' => $request->content,
            'user_id' => auth()->id(),
        ]);

        return redirect()->back()->with('success', 'Comment added');
    }
}
