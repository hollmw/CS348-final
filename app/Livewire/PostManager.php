<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;

class PostManager extends Component
{
    public $title;
    public $content;
    public $posts;

    public function mount()
    {
        $this->posts = Post::with('user')->latest()->get();
    }

    public function createPost()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $post = Post::create([
            'title' => $this->title,
            'content' => $this->content,
            'user_id' => auth()->id(),
        ]);

        $post->load('user');
        $this->posts->prepend($post);
        $this->reset(['title', 'content']);
    }

    public function render()
    {
        return view('livewire.post-manager');
    }
}