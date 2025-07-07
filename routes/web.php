<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('frontend.landingPage');
});

// admin prefix 
Route::middleware(['auth', 'verified'])->prefix('admin')->group(function () {
    Route::get('/', function () {
        return view('backend.dashboard');
    })->name('dashboard');
    Route::prefix('management')->group(function () {
        Route::get('roles', function () {
            return view('backend.management.roles');
        })->name('backend.roles');
        Route::get('users', function () {
            return view('backend.management.users.index');
        })->name('backend.users');
    });

    // Add more admin routes here
});

require __DIR__.'/auth.php';
