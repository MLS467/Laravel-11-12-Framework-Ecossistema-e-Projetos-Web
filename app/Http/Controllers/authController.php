<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

        $user = User::where('username', $request->text_username)
            ->where('deleted_at', NULL)
            ->first();

        if (!$user) {
            return redirect() // redireciona
                ->back() // volta para página anterior
                ->withInput() // volta com os valores para serem mostrado no old no front
                ->with('loginError', 'Credenciais inexistentes'); // manda msg de erro
        }


        if (!password_verify($request->text_password, $user->password)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('loginError', 'Credenciais inexistentes');
        }

        $user->last_login = date("Y-m-d H:i:s");
        $user->save();

        session([
            'user' => [
                'id' => $user->id,
                'name' => $user->username
            ]
        ]);

        return redirect()->to('/newNote');
    }


    public function logout()
    {
        session()->forget('user');

        return redirect()
            ->to('/login');
    }
}