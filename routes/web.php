<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StoryController;
use App\Http\Controllers\BatchController;

Route::get('/', function () {
    return view('home');
});

Route::get('/tales', function () {
    return view('tale');
});

Route::post('/generate-story', [StoryController::class, 'generate']);

Route::post('dispatch/batch', [BatchController::class, 'dispatchBatch']);