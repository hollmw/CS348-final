<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\User;
use Faker\Factory;


use Illuminate\Support\Facades\Http;
use App\Services\NewsApiService;



class NewsPostSeeder extends Seeder
{
    protected $newsApiService;
    protected $faker;

    public function __construct(NewsApiService $newsApiService)
    {
        $this->newsApiService = $newsApiService;
        $this->faker = Factory::create();
    }

    public function run()
    {
        
        $articles = $this->newsApiService->fetchHeadlines('us', 5);

        foreach ($articles as $article) {
            Post::create([
                'title' => $article['title'] ?? 'No Title',
                'content' => $article['description'] ?? 'No Description',
                'user_id' => 1,//;d
                'views' => $this->faker->numberBetween(0,100)
            ]);
        }
    }
}