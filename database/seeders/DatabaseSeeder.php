<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Comment;
use App\Models\Post;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\PostSeeder;
use Database\Seeders\CommentSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        // User::factory(10)->create();
        $this->call([
            PostSeeder::class, 
            CommentSeeder::class,
        ]);
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'root@admin.com',
            'role' => 'admin',
        ]);

        $users = User::factory(10)->create();

        $posts = Post::factory(5)->create();

        $this->call([
            NewsPostSeeder::class,
        ]);

        foreach ($posts as $post) {
            $numberOfComments = random_int(0, 3);
            collect(range(1, $numberOfComments))->each(function () use ($post, $users) {
                Comment::factory()->create([
                    'post_id' => $post->id,
                    'user_id' => $users->random()->id,
                ]);
            });
        }
        

        

        
    }
}
