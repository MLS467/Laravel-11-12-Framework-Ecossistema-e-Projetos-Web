<?php

namespace App\Http\Controllers\main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MainController extends Controller
{
    public function home(): View
    {
        return view('home');
    }

    public function generate_exercises(Request $request)
    {

        $request->validate(
            [
                // required_without_all se os outros campos estão vazios o campo é required
                'check_sum' => 'required_without_all:check_subtraction,check_multiplication,check_division',
                'check_subtraction' => 'required_without_all:check_sum,check_multiplication,check_division',
                'check_multiplication' => 'required_without_all:check_subtraction,check_sum,check_division',
                'check_division' => 'required_without_all:check_subtraction,check_multiplication,check_sum',
                'number_one' => 'integer|required|min:0|max:999|lt:number_two',
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

        // get operation
        $operation = [];

        if ($request->has('check_sum')) $operation[] = 'sum';
        if ($request->has('check_subtraction')) $operation[] = 'subtraction';
        if ($request->has('check_multiplication')) $operation[] = 'multiplication';
        if ($request->has('check_division')) $operation[] = 'division';

        // get number min and max
        $min_value = $request->number_one;
        $max_value = $request->number_two;

        // get number of exercises
        $number_of_exercises = $request->number_exercises;

        $data = [];
        for ($index = 1; $index <= $number_of_exercises; $index++) {
            $data[] = $this->get_operation(
                $operation[array_rand($operation)],
                $operation,
                rand($min_value, $max_value),
                rand($min_value, $max_value)
            );
        }


        return view('operations', compact('data'));
    }

    public function print_exercises(): View
    {
        return view('operation');
    }

    public function export_exercises()
    {
        return "exporta exercicios  para um arquivo";
    }

    private function get_operation(
        string $operation,
        array $data,
        string $min_value,
        string $max_value
    ): array {
        $exercises = '';
        $sollution = '';

        switch ($operation) {
            case 'sum':
                $exercises = "$min_value + $max_value =";
                $sollution = $min_value + $max_value;
                break;

            case 'subtraction':
                $exercises = "$min_value - $max_value =";
                $sollution = $min_value - $max_value;
                break;

            case 'multiplication':
                $exercises = "$min_value x $max_value =";
                $sollution = $min_value * $max_value;
                break;

            case 'division':
                $exercises = "$min_value : $max_value = ";
                $sollution = $min_value / ($max_value != '0' || 0 ? $max_value : 1);
                break;
        }

        return [
            'operation' => $operation,
            'exercises' => $exercises,
            'sollution' => "$exercises " . round($sollution, 3)
        ];
    }
}