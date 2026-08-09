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
Route::prefix('post')->group(function(){
    
    Route::get('/', [PostController::class, 'index']);
    
    Route::get('/{post}', [PostController::class, 'show']);

    Route::middleware('auth:sanctum')->group(function(){

        Route::post('/', [PostController::class, 'store']);

        Route::put('/{post}', [PostController::class, 'update']);

        Route::delete('/{post}', [PostController::class, 'destroy']);
    });
    //yo mate this one is the comments route but
    // the prefix of it is post so there is no issue in it being here
Route::get('/{post}/comments', [CommentController::class, 'index']);


});



// Comments





Route::delete('/comments/{post}', [CommentController::class, 'destroy'])
    ->middleware('auth:sanctum');