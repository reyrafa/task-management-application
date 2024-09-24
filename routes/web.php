<?php


use App\Livewire\Landing;

use App\Livewire\LoginForm;
use App\Livewire\Logout;
use Illuminate\Support\Facades\Route;

Route::get('/', Landing::class)->name('dashboard');
Route::middleware('guest')->group(function () {
    Route::get('/login', LoginForm::class)->name('login');
});


