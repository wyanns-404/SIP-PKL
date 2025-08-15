<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingPageController;

Route::get('/laravel', function () {
    return view('welcome');
});

Route::get('/', [LandingPageController::class, 'index']);
