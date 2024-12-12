<?php

namespace App\Providers;

use App\Services\NewsApiService;
use Illuminate\Support\ServiceProvider;

class NewsApiServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(NewsApiService::class, function ($app) {
            return new NewsApiService();
        });
    }

    public function boot()
    {
        //
    }
}
