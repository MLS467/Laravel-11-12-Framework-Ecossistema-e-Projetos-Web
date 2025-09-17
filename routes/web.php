<?php

use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;


Route::get('/', MainController::class);

Route::get('/one-to-one', [MainController::class, 'one_to_one']);

Route::get('/one-to-many', [MainController::class, 'one_to_many']);

Route::get('/belong-to', [MainController::class, 'belongsTo']);

Route::get('/belong-to-many', [MainController::class, 'belongsToMany']);

Route::get('/more-query-builder', [MainController::class, 'moreQueryBuilder']);

Route::get('/same-result', [MainController::class, 'sameResult']);

Route::get('/collection', [MainController::class, 'collection']);

Route::get('/serialization', [MainController::class, 'Serialization']);