<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show(User $user)
    {
    
        $user->load(['posts', 'comments']);

        return view('users.show', compact('user'));
    }
}
