<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class NewsApiService
{
    protected $baseUrl = 'https://newsapi.org/v2/';
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = config('services.news.api_key'); // Store the API key in config/services.php
    }

    public function fetchHeadlines($country = 'us', $limit = 5)
    {
        $response = Http::get($this->baseUrl . 'top-headlines', [
            'country' => $country,
            'apiKey' => $this->apiKey,
        ]);

        if ($response->successful()) {
            return array_slice($response->json()['articles'], 0, $limit);
        }

        return [];
    }
}
