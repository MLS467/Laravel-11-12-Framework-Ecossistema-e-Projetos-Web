<?php

use App\Http\Controllers\ClientsController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SingleActionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Rota Single Action
Route::get('/', SingleActionController::class);

// Rota do tipo resource
Route::resource('user', UserController::class);

// rota para Resources (multiplos)
Route::resources([
    'products' => ProductsController::class,
    'clientes' => ClientsController::class
]);