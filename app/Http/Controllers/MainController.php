<?php

namespace App\Http\Controllers;


class MainController
{

    public function index()
    {
        $this->showTitle("INDEX USANDO CONTROLLER");
    }


    public function showTitle($args)
    {
        echo "<h1>$args</h1>";
    }
}