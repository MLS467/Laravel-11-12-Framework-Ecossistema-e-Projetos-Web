<?php


//----------------------
// ROUTE PARAMETERS
//----------------------

use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

// recebendo um valor
Route::get('/valor/{value}', [MainController::class, 'recebe_valor']);

// recebendo multiplos valores
Route::get('/valor2/{value1}/{value2}', [MainController::class, 'recebe_valor2']);

// recebendo multiplos valores com request
Route::get('/valor-req/{value1}/{value2}', [MainController::class, 'recebe_valor_req']);

// recebendo valor opcional
Route::get('/valor-opc/{value_opc?}', [MainController::class, 'recebe_valor_opc']);

// recebendo valores com rota fixa junto
Route::get('/user/{user_id}/post/{post_id?}', [MainController::class, 'recebe_post']);