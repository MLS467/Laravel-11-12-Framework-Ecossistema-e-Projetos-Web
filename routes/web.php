<?php

use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;


Route::get('/', MainController::class);

Route::get('/one-to-one', [MainController::class, 'one_to_one']);


Route::get('/one-to-many', [MainController::class, 'one_to_many']);