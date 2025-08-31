<?php

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;




Route::get('/', function () {
    try {
        DB::connection()->getPdo();
        echo "Conexão realizada com sucesso!";
    } catch (\Exception $e) {
        echo "Error {$e->getMessage()}";
    }
});