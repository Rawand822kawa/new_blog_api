<?php

use Illuminate\Support\Facades\Route;
use Modules\Comments\HTTP\Controllers\CommentController;

Route::prefix('posts')->group(function () {

    Route::get('/{post}/comments', [CommentController::class, 'index']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/{post}/comments', [CommentController::class, 'store']);
    });

});

Route::middleware('auth:sanctum')->group(function () {
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy']);
});
