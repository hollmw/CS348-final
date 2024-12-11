<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


$adminMiddleware = function ($request, $next) {
    if (auth()->user() && auth()->user()->role === 'admin') {
        return $next($request);
    }

    abort(403, 'Unauthorized action.');
};

Route::get('/', [PostController::class, 'index'])->name('home');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/analytics',function() {
        if (auth()->user()->role !== 'admin'){
            abort(403, 'Unauthorised Access');
        }

        return view('analytics');
    })->name('analytics');
});

require __DIR__.'/auth.php';
