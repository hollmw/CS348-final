<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $posts = Post::all();
        $users = User::all();

        
        $posts->each(function ($post) use ($users) {
            Comment::factory(3)->create([
                'post_id' => $post->id,
                'user_id' => $users->random()->id,
            ]);
        });
    }
}
