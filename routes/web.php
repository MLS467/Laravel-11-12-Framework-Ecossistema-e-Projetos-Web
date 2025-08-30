<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    try {
        // DB::connection('MyConnect')->getPdo();
        DB::connection()->getPdo();
        DB::connection('batata')->getPdo();

        echo "conectado com sucesso!" .  DB::connection()->getDatabaseName();
        echo "</br>conectado com sucesso!" .  DB::connection('batata')->getDatabaseName();
    } catch (Exception $e) {
        echo "Erro ao conectar: " . $e->getMessage();
    }
});