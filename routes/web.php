<?php

use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    echo "ok";
});

Route::get('/show-hash', [MainController::class, 'showHash']);