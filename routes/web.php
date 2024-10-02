<?php

use App\Http\Controllers\Users\api\v1\UserController;
use App\Livewire\Landing;
use App\Livewire\LoginForm;
use App\Livewire\Profile;
use App\Livewire\TaskManagement;
use Illuminate\Support\Facades\Route;


Route::middleware('guest')->group(function () {
    Route::get('/login', LoginForm::class)->name('login');
});

Route::middleware('auth')->group(function () {
    Route::get('/', Landing::class)->name('dashboard');
    Route::get('/profile', Profile::class)
        ->name('profile');

    Route::get('/task-management', TaskManagement::class)
        ->name('task_management');
});
