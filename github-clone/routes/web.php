<?php

use App\Http\Controllers\GitHubController;
use Illuminate\Support\Facades\Route;

// Web routes
Route::get('/', function () {
    return view('index');
});

Route::get('/home', function () {
    return view('home');
});

// GitHub API routes
Route::get('/api/pulls', [GitHubController::class, 'index']);
