<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\User;

use Illuminate\Support\Facades\Http;



class NewsPostSeeder extends Seeder
{
    public function run()
    {
        // Fetch data from NewsAPI
        $response = Http::get('https://newsapi.org/v2/top-headlines', [
            'country' => 'us',
            'apiKey' => 'a453682571df48f2b57dfcfceb081bab',
        ]);

        // Debugging: Check if the response is successful
        if ($response->successful()) {
            $articles = $response->json()['articles'];

            foreach (array_slice($articles, 0, 3) as $article) {
                Post::create([
                    'title' => $article['title'] ?? 'No Title',
                    'content' => $article['description'] ?? 'No Description',
                    'user_id' => 1, // Assign to a default user
                ]);
            }
        } else {
            // Log the error response for debugging
            $this->command->error('API request failed: ' . $response->status());
            $this->command->error('Response: ' . $response->body());
        }
    }
}