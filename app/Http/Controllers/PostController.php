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


}
