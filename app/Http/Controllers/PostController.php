<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with(['comments.user', 'user']) -> get();

        return view('home', [
            'posts' => $posts,
            'isAdmin' => auth()->check() && auth()->user()->role === 'admin',
        ]);
    }
}
