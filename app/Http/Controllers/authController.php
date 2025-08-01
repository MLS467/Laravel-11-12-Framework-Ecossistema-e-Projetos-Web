<?php

namespace App\Http\Controllers;

use App\Models\User;
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
            'text_username' => 'required | email',
            'text_password' => 'required | min:6 | max:10'
        ];

        $message = [
            'text_username.required' => "O username não pode ser vázio!",
            'text_username.email' => "O username deve ser um email válido!",
            'text_password.required' => "O password não pode ser vázio!",
            'text_password.min' => "O password deve ter pelo menos :min caracteres!",
            'text_password.max' => "O password deve ter no máximo :max caracteres!",
        ];

        $request->validate($validation, $message);


        // $users = User::all()->toArray();

        $userModel = new User();
        $users = $userModel->all()->toArray();

        echo "<pre>";
        print_r($users);
        echo "</pre>";
    }


    public function logout()
    {
        return "logout";
    }
}