<?php

use App\Http\Controllers\MainController;
use App\Http\Middleware\onlyAdmin;
use Illuminate\Support\Facades\Route;

// -----------------------------------
//| ROUTE NAME                       |
// -----------------------------------

// rota raiz com redirecionamento
Route::get('/', function () {
    return redirect()->route('teste');
});


// rota nomeada
Route::get('/user', function () {
    echo "Testando Route name";
})->name('teste');


// prefixo admin 
Route::prefix('admin')->group(function () {
    // http://localhost:8000/admin/
    Route::get(
        '/',
        function () {
            echo "primeira rota admin";
        }
    );

    // http://localhost:8000/admin/home
    Route::get(
        '/home',
        function () {
            echo "home rota admin";
        }
    );
});

// middleware criado
Route::middleware([onlyAdmin::class])->group(function () {
    Route::get(
        '/admin',
        function () {
            echo "<br>";
            echo "home rota admin";
        }
    );

    Route::get(
        '/admin1',
        function () {
            echo "<br>";
            echo "home rota admin 1";
        }
    );

    Route::get(
        '/admin2',
        function () {
            echo "<br>";
            echo "home rota admin 2";
        }
    );
});

// Route::get('/home', function () {
//     echo "home rota admin";
// })->middleware(onlyAdmin::class);

// route controller 
Route::controller(MainController::class)->group(function () {
    Route::get('/teste-controller', 'index');
});

// route fallback para rotas erradas
Route::fallback(function () {
    echo "<h1>Página não encontrada</h1>";
});