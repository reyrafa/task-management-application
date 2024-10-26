<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Middleware\Category\CanEditCategory;
use App\Http\Middleware\Task\CanEditTask;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::prefix('/categories')->name('categories.')->middleware(CanEditCategory::class)->group(function () {
        Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('edit');
    });

    Route::resource('/categories', CategoryController::class)->except(['edit']);

    Route::middleware(CanEditTask::class)->prefix('/tasks/manage')->name('tasks.')->group(function () {
        Route::get('/{task}', [TaskController::class, 'show'])->name('show');
        Route::put('/{task}/update-task-status', [TaskController::class, 'updateTaskStatus'])->name('update_task_status');
        Route::post('/{task}/store-note', [TaskController::class, 'store_note'])->name('store_note');
        Route::get('/{task}/edit', [TaskController::class, 'edit'])->name('edit');
    });

    Route::resource('/tasks', TaskController::class)->except(['show', 'edit']);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
