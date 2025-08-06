<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// rota comum usando função callback
Route::get('/', function () {
    return "<h1>Hello World!</h1>";
});

// rota comum usando função callback e capiturando o request
Route::get('/injection', function (Request $request) {;
    var_dump($request);
});

// match para usar verbo http get e post 
Route::match(['get', 'post'], '/teste', function () {
    echo "teste";
});

// rota para usar todos os verbos http
Route::any('/all', function () {
    echo "teste";
});

// rota que retorna uma view diretamente
// Route::view('/', 'home');

// rota que retorna uma view diretamente com passagem de dados
Route::view('/', 'home', ['my_name' => "Maisson Leal"]);

// redirecionamento código 302
Route::redirect('/test', '/home');

// redirecionamento permanente código 301
Route::permanentRedirect('/redirect2', '/injection');