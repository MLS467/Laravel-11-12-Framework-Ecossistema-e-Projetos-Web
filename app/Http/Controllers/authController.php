<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class authController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function login_submit(Request $request)
    {
        $validation = [
            'text_username' => 'required',
            'text_password' => 'required'
        ];

        // validação, caso tenha erro, volta com a variável errors para a tela anterior
        $request->validate($validation);


        return "ok";
    }


    public function logout()
    {
        return "logout";
    }
}