<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'body', 'user_id','views'];

    public function addViews()
    {
        $this -> increment('views');
    }

    public function show(Post $post)
    {
        $post->addViews();
        return view('post.show', compact('post'));
    }

    


}
