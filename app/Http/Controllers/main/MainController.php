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
        // dd($request->number_exercises);

        $request->validate(
            [
                // required_without_all se os outros campos estão vazios o campo é required
                'check_sum' => 'required_without_all:check_subtraction,check_multiplication,check_division',
                'check_subtraction' => 'required_without_all:check_sum,check_multiplication,check_division',
                'check_multiplication' => 'required_without_all:check_subtraction,check_sum,check_division',
                'check_division' => 'required_without_all:check_subtraction,check_multiplication,check_sum',
                'number_one' => 'integer|required|min:0|max:999',
                'number_two' => 'integer|required|min:0|max:999',
                'number_exercises' => 'integer|required|min:5|max:50'
            ],
            [
                'check_sum.required_without_all' => 'Selecione pelo menos uma operação.',
                'check_subtraction.required_without_all' => 'Selecione pelo menos uma operação.',
                'check_multiplication.required_without_all' => 'Selecione pelo menos uma operação.',
                'check_division.required_without_all' => 'Selecione pelo menos uma operação.',

                'number_one.required' => 'O campo número 1 é obrigatório.',
                'number_one.min' => 'O número 1 deve ser no mínimo 0.',
                'number_one.max' => 'O número 1 deve ser no máximo 999.',

                'number_two.required' => 'O campo número 2 é obrigatório.',
                'number_two.min' => 'O número 2 deve ser no mínimo 0.',
                'number_two.max' => 'O número 2 deve ser no máximo 999.',

                'number_exercises.required' => 'O campo quantidade de exercícios é obrigatório.',
                'number_exercises.min' => 'A quantidade mínima de exercícios é :min',
                'number_exercises.max' => 'A quantidade máxima de exercícios é :max.',
            ]
        );

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