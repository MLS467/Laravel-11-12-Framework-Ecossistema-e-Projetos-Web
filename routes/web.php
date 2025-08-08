<?php

use App\Http\Controllers\main\MainController;
use App\Http\Middleware\EndMiddleware;
use App\Http\Middleware\StartMiddleware;
use Illuminate\Support\Facades\Route;


// Route::controller(MainController::class)->group(function () {
//     Route::get(
//         '/index',
//         'index'
//     )
//         ->name("index")
//         ->middleware(StartMiddleware::class);


//     Route::get(
//         '/about',
//         'about'
//     )
//         ->name("about")
//         ->middleware(EndMiddleware::class);



//     Route::get(
//         '/contact',
//         'contact'
//     )
//         ->name("contact")
//         ->middleware([
//             StartMiddleware::class,
//             EndMiddleware::class
//         ]);
// });


Route::controller(MainController::class)->group(function () {
    Route::middleware([StartMiddleware::class, EndMiddleware::class])->group(function () {

        Route::get(
            '/index',
            'index'
        )
            ->name("index")
            ->withoutMiddleware(EndMiddleware::class);


        Route::get(
            '/about',
            'about'
        )
            ->name("about");



        Route::get(
            '/contact',
            'contact'
        )
            ->name("contact");
    });
});