<?php

namespace App\Http\Controllers;

use App\Services\MainOperations;

class MainController extends Controller
{
    public function index(): string
    {
        return "Hello World Test";
    }

    public function showHash(): string
    {
        return MainOperations::hash_generation();
    }
}