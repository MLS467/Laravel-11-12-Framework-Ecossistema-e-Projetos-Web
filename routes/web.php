<?php

use App\Http\Controllers\admin\AdminController;
use Illuminate\Support\Facades\Route;


Route::get(
    '/index',
    [AdminController::class, 'index']
)->name('index');