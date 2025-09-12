<?php

namespace App\Http\Controllers;

abstract class Controller
{
    public function show_data($data): void
    {
        echo '<pre>';
        print_r($data);
        echo '</pre>';
    }
}
