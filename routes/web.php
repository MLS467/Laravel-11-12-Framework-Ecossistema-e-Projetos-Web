<?php

use App\Http\Controllers\main\MainController;
use Illuminate\Support\Facades\Route;

Route::controller(MainController::class)->group(function () {

    Route::get(
        '/index',
        'index'
    )
        ->name("index")
        ->middleware('ocorre_depois');


    Route::get(
        '/about',
        'about'
    )
        ->name("about");



    Route::get(
        '/contact',
        'contact'
    )
        ->name("contact");
});