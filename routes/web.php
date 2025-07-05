<?php

use Illuminate\Support\Facades\Route;

Route::get('/laravel', function () {
    return view('welcome');
});

Route::get('/', function () {
    return view('frontend.landingPage');
});

// admin area
Route::prefix('admin')->group(function () {
    Route::get('/', function () {
        return view('backend.index');
    }); 
});