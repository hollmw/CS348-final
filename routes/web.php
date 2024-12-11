<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

// Public route (accessible to everyone)
Route::get('/', [PostController::class, 'index'])->name('home');

// Authenticated routes
Route::middleware(['auth'])->group(function () {
    // Dashboard route (requires authentication)
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware('verified')->name('dashboard');

    // Profile management routes (requires authentication)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Analytics route (requires admin role)
    Route::get('/analytics', function () {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized Access');
        }

        return view('analytics');
    })->name('analytics');

    Route::get('/', [PostController::class, 'index'])->name('home');
    Route::post('/comments/{post}', [CommentController::class, 'store'])->name('comments.store');
});

// Default auth routes (login, registration, etc.)
require __DIR__.'/auth.php';
