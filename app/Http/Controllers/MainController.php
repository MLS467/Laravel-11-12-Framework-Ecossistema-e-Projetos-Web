<?php

namespace App\Http\Controllers;


class MainController extends Controller
{
    public function index($value = null): string
    {
        return $this->cleanToUpperCase($value);
    }
}