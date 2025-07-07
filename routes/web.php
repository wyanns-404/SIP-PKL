<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// admin prefix 
Route::middleware(['auth', 'verified'])->prefix('admin')->group(function () {
    Route::get('/', function () {
        return view('backend.index');
    })->name('dashboard');
    Route::prefix('management')->group(function () {
        Route::get('roles', function () {
            return view('backend.management.roles');
        })->name('roles');
        Route::get('users', function () {
            return view('backend.management.users');
        })->name('users');
    });

    // Add more admin routes here
});

require __DIR__.'/auth.php';
