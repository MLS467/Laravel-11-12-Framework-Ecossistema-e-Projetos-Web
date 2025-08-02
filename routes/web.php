<?php

use App\Http\Controllers\authController;
use App\Http\Controllers\MainController;
use App\Http\Middleware\checkIsLogged;
use App\Http\Middleware\checkIsNotLogged;
use Illuminate\Support\Facades\Route;


Route::middleware([checkIsNotLogged::class])->group(function () {
    // view do login
    Route::get("/", [authController::class, "login"]);

    // rota para submit do login
    Route::post("/login_submit", [authController::class, "login_submit"]);
});


Route::middleware([checkIsLogged::class])->group(function () {
    // rota para logout
    Route::get("/logout", [authController::class, "logout"])->name('logout');
    Route::get("/newNote", [MainController::class, "newNote"])->name('new');
    Route::get("/home", [MainController::class, "index"])->name('home');
});