<?php

namespace App\Http\Controllers\main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function home()
    {
        return "Página inicial";
    }

    public function generate_exercises(Request $request)
    {
        return "gerar exercicios";
    }

    public function print_exercises()
    {
        return "Imprime exercicios no navegador";
    }

    public function export_exercises()
    {
        return "exporta exercicios  para um arquivo";
    }
}