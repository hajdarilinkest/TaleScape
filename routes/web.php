<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StoryController;

Route::get('/', function () {
    return view('home');
});

Route::get('/tales', function () {
    return view('tale');
});

Route::post('/generate-story', [StoryController::class, 'generate']);
