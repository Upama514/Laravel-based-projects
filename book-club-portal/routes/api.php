<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PageController;

// ✅ Public Routes
Route::get('/home', [PageController::class, 'home']);
Route::get('/about', [PageController::class, 'about']);

// ✅ Test Route (CORS check এর জন্য)
Route::get('/test', function () {
    return response()->json([
        'message' => 'CORS is working!',
        'status' => 'success'
    ]);
});

// ✅ Authentication (Public)
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// ✅ Protected Routes (Authenticated Users)
Route::middleware('auth:sanctum')->group(function () {
    // Auth
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'userProfile']);

    // Books CRUD
    Route::get('/books', [BookController::class, 'index']);
    Route::post('/books', [BookController::class, 'store']);
    Route::get('/books/{book}', [BookController::class, 'show']);
    Route::put('/books/{book}', [BookController::class, 'update']);
    Route::delete('/books/{book}', [BookController::class, 'destroy']);

    // Comments
    Route::get('/books/{book}/comments', [CommentController::class, 'index']);
    Route::post('/books/{book}/comments', [CommentController::class, 'store']);
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy']);
});

// ✅ Admin-only Routes
Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
    Route::get('/admin/users', [AdminController::class, 'getUsers']);
    Route::get('/admin/books', [AdminController::class, 'getAllBooks']);
    Route::delete('/admin/books/{book}', [AdminController::class, 'deleteBook']);
});