<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// prefix admin
Route::prefix('admin')->group(function () {
    Route::get('/', function () {
        return view('backend.index');
    })->name('admin.dashboard');

    // Other admin routes can be added here
});