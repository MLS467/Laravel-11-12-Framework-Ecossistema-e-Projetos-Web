<?php

namespace App\Http\Controllers\main;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request): View
    {
        /* método 1
        $data = ['nome' => 'Maisson'];

        return view(
            'home',
            $data
        );
        */

        /* método 2
        return view(
            'home',
            ['nome' => 'Maisson']
        );
        */

        // método 3
        $nome = 'Shaolin Matador de porco';
        return view(
            'home',
            compact('nome')
        );
    }
    public function admin(Request $request): View
    {
        return view(
            'admin.page',
            ['nome' => 'Maisson']
        );
    }
}