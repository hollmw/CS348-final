<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentController;
use App\Livewire\PostManager;


// Public route (accessible to everyone)
Route::get('/', [PostController::class, 'index'])->name('home');


// Authenticated routes
Route::middleware(['auth'])->group(function () {
    //requires authentication
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware('verified')->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/analytics', function () {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized Access');
        }

        return view('analytics');
    })->name('analytics');

    Route::get('/', [PostController::class, 'index'])->name('home');
    Route::post('/comments/{post}', [CommentController::class, 'store'])->name('comments.store');
    //debug
    Route::get('/test', function () {
        return "PostController is recognized.";
    });

    Route::post('/comments/{post}', [CommentController::class, 'store'])->name('comments.store');
    Route::get('/', function () {return view('home');})->name('home');


    Route::get('/test-livewire', function () {
        return view('home');
    })->name('test-livewire');

});

// Default auth routes (login, registration, etc.)
require __DIR__.'/auth.php';
