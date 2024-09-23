<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\Users\v1\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// version 1
Route::prefix('/v1')->group(function () {

    Route::post('/register', [UserController::class, 'register']);
    Route::post('/login', [UserController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::prefix('/tasks')->group(function () {
            Route::post('/add', [TaskController::class, 'add_task']);
        });
    });
});
