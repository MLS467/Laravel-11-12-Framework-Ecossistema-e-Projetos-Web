<?php

use App\Http\Middleware\EndMiddleware;
use App\Http\Middleware\StartMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {

        // // adicionar middleware a todas as rotas (executa antes da resposta das rotas)
        // $middleware->prepend([StartMiddleware::class]);
        // // $middleware->prepend([StartMiddleware::class, EndMiddleware::class]);

        // // adicionar middleware a todas as rotas (executa depois da resposta das rotas)
        // $middleware->prepend([EndMiddleware::class]);

        // criando grupo de middlewares
        $middleware->prependToGroup('ocorre_antes', [
            StartMiddleware::class
        ]);

        $middleware->appendToGroup('ocorre_depois', [
            EndMiddleware::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();