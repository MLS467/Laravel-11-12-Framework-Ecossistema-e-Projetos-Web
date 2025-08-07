<?php

use App\Http\Controllers\MainController;
use App\Http\Middleware\onlyAdmin;
use Illuminate\Support\Facades\Route;

Route::prefix('sistema')->group(function () {
    Route::controller(MainController::class)->group(function () {
        Route::get('/', 'index')->middleware([onlyAdmin::class]);
        Route::get('/home', 'teste');
    });
});