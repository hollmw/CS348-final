<?php

namespace App\Livewire;

use App\Models\Post;
use App\Models\Comment;
use Livewire\Component;

class PostManager extends Component
{
    public $title;
    public $content;
    public $posts;
    public $newComment = [];

    public function mount()
    {
        $this->loadPosts();
    }

    public function loadPosts()
    {
        $this->posts = Post::with(['user', 'comments.user'])->latest()->get();
    }

    public function addComment($postId)
    {
        $this->validate([
            "newComment.$postId" => 'required|min:2'
        ]);

        Comment::create([
            'content' => $this->newComment[$postId],
            'user_id' => auth()->id(),
            'post_id' => $postId
        ]);

        $this->newComment[$postId] = '';
        $this->loadPosts();
    }

    public function createPost()
    {
        $this->validate([
            'title' => 'required',
            'content' => 'required'
        ]);

        Post::create([
            'title' => $this->title,
            'content' => $this->content,
            'user_id' => auth()->id()
        ]);

        $this->title = '';
        $this->content = '';
        $this->loadPosts();
    }

    public function render()
    {
        return view('livewire.post-manager');
    }
}
