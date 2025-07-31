<?php

use App\Http\Controllers\authController;
use Illuminate\Support\Facades\Route;

// view do login
Route::get("/login", [authController::class, "login"]);

// rota para submit do login
Route::post("/login_submit", [authController::class, "login_submit"]);

// rota para logout
Route::get("/logout", [authController::class, "logout"]);