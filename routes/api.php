<?php

use App\Http\Controllers\ClientController;
use Illuminate\Support\Facades\Route;


Route::controller(ClientController::class)->group(function () {
    Route::get('/status', 'status');
    Route::get('/clients', 'index');
    Route::get('/client/{client}', 'show');
    Route::get('/client-pagination', 'pagination');
    Route::post('/client-by-id', 'client_by_id');
});