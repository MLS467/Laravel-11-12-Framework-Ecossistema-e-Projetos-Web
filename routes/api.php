<?php

use App\Http\Controllers\Api\auth\AuthController;
use App\Http\Controllers\Api\client\ClientController;
use Illuminate\Support\Facades\Route;




Route::middleware('guest')->group(function () {

    route::post('/login', [AuthController::class, 'login']);
});


Route::middleware('auth:sanctum')->group(function () {

    Route::get('/status', function () {
        return response()->json(
            [
                'status' => 'ok',
                'message' => 'this API is running'
            ]
        );
    });

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::apiResource('client', ClientController::class);
});