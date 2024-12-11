<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with(['comments.user', 'user']) -> get();

        $isAdmin = auth()->check() && auth()->user()->role === 'admin';

        return view('home', [
            'posts' => $posts,
            'isAdmin' => $isAdmin,
        ]);
    }
}
