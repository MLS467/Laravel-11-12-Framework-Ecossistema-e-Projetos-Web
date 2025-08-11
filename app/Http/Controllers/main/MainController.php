<?php

namespace App\Http\Controllers\main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class MainController extends Controller
{
    public function home(): View
    {
        return view('home');
    }

    public function generate_exercises(Request $request)
    {
        return Response()->json([$request->input()], 200);
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