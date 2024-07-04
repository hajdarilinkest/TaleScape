<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\TextSimilarityServices;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(TextSimilarityServices::class, function ($app) {
            return new TextSimilarityServices();
        });
    }
}
