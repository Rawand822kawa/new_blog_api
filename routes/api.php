<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Modules\User\Controllers\AuthController;
use App\Modules\Posts\Controllers\PostController;
use App\Modules\Comments\Controllers\CommentController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Authentication
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth:sanctum');

// Posts
Route::get('/posts', [PostController::class, 'index']);
Route::get('/posts/{post}', [PostController::class, 'show']);

Route::post('/posts', [PostController::class, 'store'])
    ->middleware('auth:sanctum');

Route::put('/posts/{post}', [PostController::class, 'update'])
    ->middleware('auth:sanctum');

Route::delete('/posts/{post}', [PostController::class, 'destroy'])
    ->middleware('auth:sanctum');

// Comments
Route::get('/posts/{post}/comments', [CommentController::class, 'index']);



Route::delete('/comments/{post}', [CommentController::class, 'destroy'])
    ->middleware('auth:sanctum');