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
        $apiKey = config('similarityapi.TWINWORD_API_KEY');

        $this->app->singleton(TextSimilarityServices::class, function ($app) use ($apiKey) {
            return new TextSimilarityServices($apiKey);
        });
    }
}
