<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\CommentController;

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
Route::get('/posts/{id}', [PostController::class, 'show']);

Route::post('/posts', [PostController::class, 'store'])
    ->middleware('auth:sanctum');

Route::put('/posts/{id}', [PostController::class, 'update'])
    ->middleware('auth:sanctum');

Route::delete('/posts/{id}', [PostController::class, 'destroy'])
    ->middleware('auth:sanctum');

// Comments
Route::get('/posts/{id}/comments', [CommentController::class, 'index']);

Route::post('/posts/{id}/comments', [CommentController::class, 'store'])
    ->middleware('auth:sanctum');

Route::delete('/comments/{id}', [CommentController::class, 'destroy'])
    ->middleware('auth:sanctum');