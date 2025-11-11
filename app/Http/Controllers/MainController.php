<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    public function __invoke(): View
    {
        $auth = Auth::user();
        $name = $auth->name;
        $email = $auth->email;

        return view('home', compact('name', 'email'));
    }
}