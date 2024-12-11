<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    protected $model = Post::class;


    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'content' => $this->faker->text(255),
            'user_id' => User::factory(),
            'views' => $this->faker->numberBetween(0,100),
        ];
    }
}
