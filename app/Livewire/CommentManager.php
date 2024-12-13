<?php

namespace App\Livewire;

use App\Models\Comment;
use Livewire\Component;
use App\Models\Post;

class CommentManager extends Component
{
    public $post;
    public $newComment = '';

    protected $queryString = ['page' => ['except' => 1]];



    public function mount($post)
    {
        $this->post = $post;
    }

    //show ajax
    public function addComment()
    {
        //further validation
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
        return view('livewire.comment-manager', [
            'comments' => Comment::query()
                ->when($this->search, function ($query) {
                    $query->where('content', 'like', '%' . $this->search . '%');
                })
                ->orderBy('created_at', 'desc')
                ->paginate($this->perPage)//paginate
            ]);
    }
}
