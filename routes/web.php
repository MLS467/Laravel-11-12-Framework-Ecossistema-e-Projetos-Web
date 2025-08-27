<?php

use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

Route::controller(MainController::class)->group(function () {
    Route::get('/', 'startGame')
        ->name('startGame');

    Route::post('/prepare-game', 'prepareGame')
        ->name('prepareGame');

    Route::get('/game', 'game')
        ->name('game');

    Route::get('/answer/{answer}', 'answer')
        ->name('answer');

    Route::get('/nextQuestion', 'nextQuestion')
        ->name('nextQuestion');

    Route::get('/show_result', 'show_result')
        ->name('show_result');
});