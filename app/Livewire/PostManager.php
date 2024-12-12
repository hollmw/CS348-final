<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;

class PostManager extends Component
{
    public $title;
    public $content;
    public $posts;

    public function mount()
    {
        $this->posts = Post::with('user')->get();
    }

    public function createPost()
    {
        $post = Post::create([
            'title' => $this->title,
            'content' => $this->content,
            'user_id' => auth()->id()
        ]);

        $this->title = '';
        $this->content = '';
        
        // Refresh the posts list
        $this->posts = Post::with('user')->get();
    }

    public function render()
    {
        return view('livewire.post-manager');
    }
}