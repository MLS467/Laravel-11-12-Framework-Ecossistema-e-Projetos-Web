<?php

use App\Http\Controllers\authController;
use App\Http\Controllers\MainController;
use App\Http\Middleware\checkIsLogged;
use App\Http\Middleware\checkIsNotLogged;
use Illuminate\Support\Facades\Route;


// middleware para testar se não está usuário está logado!
Route::middleware([checkIsNotLogged::class])->group(function () {
    // view do login
    Route::get("/", [authController::class, "login"]);

    // rota para submit do login
    Route::post("/login_submit", [authController::class, "login_submit"]);
});




// middleware para testar se o usuário está logado!
Route::middleware([checkIsLogged::class])->group(function () {
    // rota para logout
    Route::get("/logout", [authController::class, "logout"])->name('logout');

    // rota para home
    Route::get("/home", [MainController::class, "index"])->name('home');

    // rotas para nota
    Route::get("/newNote", [MainController::class, "newNote"])->name('new');
    Route::get('/editNote/{id}', [MainController::class, 'editNote'])->name('editNote');
    Route::put("/notesubmit", [MainController::class, "editNoteSubmit"])->name('editNoteSubmit');
    Route::get('/deleteNote/{id}', [MainController::class, 'deleteNote'])->name('deleteNote');
});