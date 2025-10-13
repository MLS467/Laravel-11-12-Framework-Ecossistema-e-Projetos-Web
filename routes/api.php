<?php

use App\Http\Controllers\ClientController;
use Illuminate\Support\Facades\Route;


Route::controller(ClientController::class)->group(function () {
    Route::get('/status', 'status');
    Route::get('/clients', 'index');
    Route::get('/client/{client}', 'show');
    Route::get('/client-pagination', 'pagination');
    Route::post('/client-by-id', 'client_by_id');
    Route::post('/add-client', 'add_client');
    Route::put('/update-client/{id}', 'update_client');
    Route::delete('/delete-client/{id}', 'delete_client');
});