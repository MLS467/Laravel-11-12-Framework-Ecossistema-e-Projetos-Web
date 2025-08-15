<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class MainController extends Controller
{
    public function show(): View
    {
        $languege_peoples = [
            'john' => [
                'portuguese',
                'english',

            ],
            'maria' => [
                'portuguese',
            ],
            'james' => [
                'portuguese',
                'english',
                'france'
            ],
        ];


        return view('home', compact('languege_peoples'));
    }
}