<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    try {
        DB::connection()->getPdo();

        echo "conectado com sucesso!";
    } catch (Exception $e) {
        echo "Erro ao conectar: " . $e->getMessage();
    }
});