<?php

use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;


Route::get('/', MainController::class);

Route::get('/one-to-one', [MainController::class, 'one_to_one']);