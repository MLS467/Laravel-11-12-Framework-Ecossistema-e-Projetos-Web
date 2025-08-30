<?php

use Illuminate\Support\Facades\Config;
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

Route::get('/dinamica', function () {

    try {
        // adiciona configurações ai config/database.php
        Config::set(
            'database.connections.batata',
            [
                'driver' => 'mysql',
                'url' => '',
                'host' => 'localhost',
                'port' => 3306,
                'database' => 'curso_laravel_2',
                'username' => env('DB_USERNAME', 'root'),
                'password' => env('DB_PASSWORD', ''),
                'unix_socket' => env('DB_SOCKET', ''),
                'charset' => env('DB_CHARSET', 'utf8mb4'),
                'collation' => env('DB_COLLATION', 'utf8mb4_unicode_ci'),
                'prefix' => '',
                'prefix_indexes' => true,
                'strict' => true,
                'engine' => null,
                'options' => extension_loaded('pdo_mysql') ? array_filter([
                    PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
                ]) : [],
            ]
        );

        echo "conectado: " . DB::connection('batata')->getDatabaseName();
    } catch (Exception $e) {
        echo "Erro ao conectar: " . $e->getMessage();
    }
});