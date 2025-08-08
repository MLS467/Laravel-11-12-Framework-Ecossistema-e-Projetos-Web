<?php

namespace App\Http\Controllers\main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index(Request $request): string
    {
        return $this->cleanToUpperCase("INDEX");
    }

    public function about(Request $request): string
    {
        return  $this->cleanToUpperCase("ABOUT");
    }

    public function contact(Request $request): string
    {
        return $this->cleanToUpperCase("CONTACT");
    }
}