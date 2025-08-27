<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\View\View;

class MainController extends Controller
{
    private array $countryAndCapitals;

    public function __construct()
    {
        $this->countryAndCapitals = require app_path('/Data/data.php');
    }

    public function startGame(): View
    {
        return view('home');
    }

    public function prepareGame(Request $request)
    {
        // validate request
        $request->validate(
            [
                'total_questions' => 'required | min:3 | max:30 | integer'
            ],
            [
                'total_questions.required' => 'O campo Número de perguntas é obrigatório.',
                'total_questions.min' => 'O campo deve ter o valor mínimo de :min.',
                'total_questions.max' => 'O campo deve ter o valor máximo de :max.',
                'total_questions.integer' => 'O campo deve deve ser um valor númerico inteiro.'
            ]
        );

        $total_questions = intval($request->total_questions);

        $quiz = $this->prepareQuiz($total_questions);

        session()->put([
            'quiz' => $quiz,
            'total_questions' => $total_questions,
            'current_question' => 1,
            'correct_answer' => 0,
            'wrong_answer' => 0,
        ]);

        return redirect()->route('game');
    }

    private function prepareQuiz(int $total_question)
    {
        $questions = [];
        // pega valor total de questoes
        $num_total_question = count($this->countryAndCapitals);

        // retorna um array de numeros de 0 a num_total_question - 1
        $range_num_total_question = range(0, $num_total_question - 1);

        // embaralha os numeros sem repetir
        shuffle($range_num_total_question);

        // pega a quantidade de questões para o game
        $number_questions = array_slice($range_num_total_question, 0, $total_question);

        $count = 1;

        foreach ($number_questions as $number_question_index) {
            $question['number_question'] = $count++;
            $question['country'] = $this->countryAndCapitals[$number_question_index]['country'];
            $question['correct_answer'] = $this->countryAndCapitals[$number_question_index]['capital'];

            // pega todas só as colunas capital
            $other_capitals = array_column($this->countryAndCapitals, 'capital');

            // remove o valor da capital em other capitals que esta no segundo paramentro
            $other_capitals = array_diff($other_capitals, [$question['correct_answer']]);

            shuffle($other_capitals);

            $question['wrong_answers'] = array_slice($other_capitals, 0, 3);

            $question['correct'] = null;

            $questions[] = $question;
        }

        return $questions;
    }

    public function game(): View
    {
        $quiz = session()->get('quiz');
        $total_questions = session()->get('total_questions');
        $current_question = session()->get('current_question') - 1;

        $answers = $quiz[$current_question]['wrong_answers'];
        $answers[] = $quiz[$current_question]['correct_answer'];

        shuffle($answers);

        return view('game')->with([
            'country' => $quiz[$current_question]['country'],
            'total_questions' => $total_questions,
            'current_question' => $current_question,
            'answers' => $answers
        ]);
    }


    public function answer($dec_answer): View
    {
        $answer = Crypt::decryptString($dec_answer);

        $quiz = session('quiz'); // array para atualiza-lo
        $current_question = session('current_question') - 1; // valor do index de questão atual
        $correct_answer_value = $quiz[$current_question]['correct_answer']; // resposta correta
        $correct_answer_count = session('correct_answer'); // contador acerto
        $wrong_answer = session('wrong_answer'); // contador erro

        if ($answer == $correct_answer_value) {
            $correct_answer_count++;
            session()->put('correct_answer', $correct_answer_count);
            $quiz[$current_question]['correct'] = true;
        } else {
            $wrong_answer++;
            session()->put('wrong_answer', $wrong_answer);
            $quiz[$current_question]['correct'] = false;
        }

        session()->put([
            "quiz" => $quiz,
            "correct_answers " => $correct_answer_value,
            "wrong_answers" => $wrong_answer
        ]);

        $data = [
            'country' => $quiz[$current_question]['country'],
            'choice_answer' => $answer,
            "correct_answer" => $correct_answer_value,
            "current_question" => $current_question,
            'total_questions' => session('total_questions'),
        ];

        return view('question_result')->with($data);
    }


    public function nextQuestion()
    {
        $current_question = session()->get('current_question');
        $total_questions = session()->get('total_questions');

        if ($current_question < $total_questions) {
            $current_question++;
            session()->put('current_question', $current_question);
            return redirect()->route('game');
        } else {
            return redirect()->route('show_result');
        }
    }

    public function show_result(): View
    {
        return view('final_result')->with([
            'total_questions' => session('total_questions'),
            'correct_answers' => session('correct_answer'),
            'wrong_answers' => session('wrong_answers'),
            'percent' => round((session('correct_answer') * 100) / session('total_questions'), 2)
        ]);
    }
}