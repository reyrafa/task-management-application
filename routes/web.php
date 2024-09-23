<?php

use App\Http\Controllers\BaseController;
use App\Livewire\Landing;
use Illuminate\Support\Facades\Route;

Route::get('/', Landing::class);
