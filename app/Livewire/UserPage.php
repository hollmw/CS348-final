<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Models\Post;
use App\Models\Comment;


class UserPage extends Component
{
    public $user;
    public $posts;
    public $comments;

    public function mount(User $user)
    {
        // Assign the user model
        $this->user = $user;

        // Fetch the user's posts and comments
        $this->posts = $user->posts()->latest()->get();
        $this->comments = $user->comments()->with('post')->latest()->get();
    }

    public function render()
    {
        return view('livewire.user-page')->layout('layouts.app');;
    }
}
