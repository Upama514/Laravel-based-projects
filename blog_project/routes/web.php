<?php

use App\Http\Controllers\BlogController;
use Illuminate\Support\Facades\Route;

// ----------------------------
// Redirect root to blogs index
// ----------------------------
Route::get('/', function () {
    return redirect()->route('blogs.index');
});

// ----------------------------
// Authenticated user routes
// ----------------------------
Route::middleware(['auth'])->group(function () {

    // Blog CRUD routes
    Route::resource('blogs', BlogController::class);

});

// ----------------------------
// Authentication routes (login, register, logout)
// ----------------------------
require __DIR__.'/auth.php';
