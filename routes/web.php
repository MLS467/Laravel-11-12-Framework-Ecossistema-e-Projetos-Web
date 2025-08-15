<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'home', ['teste2' => 123456789]);
Route::view('/other', 'other');