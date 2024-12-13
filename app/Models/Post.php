<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'user_id'];

    public function addViews()
    {
        $this -> increment('views');
    }

    public function show(Post $post)
    {
        $post->addViews();
        return view('post.show', compact('post'));
    }
    //relationships

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //relationships


}
