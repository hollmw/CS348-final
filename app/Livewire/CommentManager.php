<?php

namespace App\Livewire;

use App\Models\Comment;
use Livewire\Component;

class CommentManager extends Component
{
    public $post;
    public $newComment = '';

    public function mount($post)
    {
        $this->post = $post;
    }

    public function addComment()
    {
        $this->validate([
            'newComment' => 'required|min:2'
        ]);

        Comment::create([
            'content' => $this->newComment,
            'user_id' => auth()->id(),
            'post_id' => $this->post->id
        ]);

        $this->newComment = '';
        $this->post->refresh();
    }

    public function render()
    {
        return view('livewire.comment-manager');
    }
}
