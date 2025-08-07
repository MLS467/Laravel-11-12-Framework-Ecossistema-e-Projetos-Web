<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class MainController
{
    public function index(): void
    {
        $this->showTitle("Home Content");
    }

    public function teste(): View
    {
        return view('home');
    }


    public function showTitle($args)
    {
        echo "<h1>$args</h1>";
    }
}