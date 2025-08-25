<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class MainController extends Controller
{
    private $countryAndCapitals;

    public function __construct()
    {
        $this->countryAndCapitals = require app_path('/Data/data.php');
    }


    public function show(): View
    {
        return  view('home', ['data' => $this->countryAndCapitals]);
    }
}