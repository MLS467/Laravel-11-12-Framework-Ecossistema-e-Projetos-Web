<?php

use App\Http\Controllers\main\HomeController;
use App\Http\Middleware\getIp;
use Illuminate\Support\Facades\Route;

Route::get(
    '/',
    [HomeController::class, 'index']
)
    ->name('home')
    ->middleware(getIp::class);