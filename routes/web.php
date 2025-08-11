<?php

use App\Http\Controllers\main\MainController;
use Illuminate\Support\Facades\Route;

Route::controller(MainController::class)->group(function () {

    Route::get(
        '/',
        'home'
    )->name('home');

    Route::post(
        '/generate_exercises',
        'generate_exercises'
    )->name('gen_exe');

    Route::get(
        '/print_exercises',
        'print_exercises'
    )->name('print');

    Route::get(
        '/export_exercises',
        'export_exercises'
    )->name('export');
});