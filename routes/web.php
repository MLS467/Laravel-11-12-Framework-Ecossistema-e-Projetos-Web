<?php

//-----------------------------------
// ROUTE PARAMETERS WITH CONSTRAINTS
//-----------------------------------

use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

// Route::get('/user/{user_id}/post/{post_id?}', [MainController::class, 'post']);
// Route::get('/user/{user_id}/post/{post_id?}', function ($user_id, $post_id = null) {
//     echo "USER ID = $user_id e POST ID = $post_id";
// })->where('user_id', '[0-9]+');

// Route::get('/user/{user_id}/post/{post_id?}', function ($user_id, $post_id = null) {
//     echo "USER ID = $user_id e POST ID = $post_id";
// })->where('post_id', '[a-zA-Z0-9]+');

Route::get('/user/{user_id}/post/{post_id?}', function ($user_id, $post_id = null) {
    echo "USER ID = $user_id e POST ID = $post_id";
})->where([
    'user_id' => '[0-9]+',
    'post_id' => '[a-zA-Z0-9]+'
]);