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
            // random min and max
            $min = rand($min_value, $max_value);
            $max = rand($min_value, $max_value);
            $data[] = $this->get_exercises($operation, $min, $max);
        }

        $request->session()->put('exercises', $data);

        return view('operations', compact('data'));
    }

    public function print_exercises(): View | \Illuminate\Routing\Redirector | \Illuminate\Http\RedirectResponse
    {
        if (!session()->has('exercises'))
            return redirect()->route('home');

        $exercises = session()->get('exercises');

        return view('print_exercises', ['exercises' => $exercises]);
    }

    public function export_exercises()
    {
        if (!session()->has('exercises'))
            return redirect()->route('home');

        $sep = str_repeat('-', 10);
        $app_name = env('APP_NAME');
        $date = date("YmdHis");
        $exercises = session()->get('exercises');

        $filename = "Exercícios_{$app_name}_{$date}.txt\n";

        $content = "$sep Exercícios $app_name $sep\n\n";

        foreach ($exercises as $index => $exercise) {
            $count = $index + 1;
            $content .= "{$count} => {$exercise['exercises']} \n";
        }

        $sep = str_repeat('-', 10);
        $content .= "\n\n$sep Soluções $sep \n\n";

        foreach ($exercises as $index => $exercise) {
            $count = $index + 1;
            $content .= "{$count} => {$exercise['sollution']} \n";
        }

        return response($content)
            ->header('Content-Type', 'text/plain')
            ->header('Content-Disposition', "attachment; filename=$filename");
    }

    private function get_exercises(
        array $data,
        string $min_value,
        string $max_value
    ): array {
        $operation = $data[array_rand($data)];
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