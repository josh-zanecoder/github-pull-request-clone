<?php

use App\Http\Controllers\GitHubController;
use Illuminate\Support\Facades\Route;

Route::get('/pulls', [GitHubController::class, 'index']); 