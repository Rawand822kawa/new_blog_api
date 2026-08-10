<?php

use Illuminate\Support\Facades\Route;
use Modules\Post\Controllers\PostController;

Route::prefix('posts')->group(function () {

    Route::get('/', [PostController::class, 'index']);
    Route::get('/{post}', [PostController::class, 'show']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/', [PostController::class, 'store']);
        Route::put('/{post}', [PostController::class, 'update']);
        Route::delete('/{post}', [PostController::class, 'destroy']);
    });

});