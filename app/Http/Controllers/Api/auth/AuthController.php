<?php

namespace App\Http\Controllers\Api\auth;

use App\Http\Controllers\Controller;
use App\Http\Services\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $this->validate_login($request);

        $cred = [
            'email' => $request->email,
            'password' => $request->password
        ];

        $result = Auth::attempt($cred);

        if (!$result) {
            return ApiResponse::error(401, 'Email ou senha estão incorretos.');
        }

        $user = Auth::user();
        $abilits = ['client:list', 'client:details', 'client:store', 'client:destroy'];

        $token = $user->createToken($user->name, $abilits, now()->addHour())->plainTextToken;

        return ApiResponse::success(
            [compact('token', 'user')],
            200,
            'Login efetuado com sucesso.'
        );
    }

    public function logout(Request $request)
    {
        $user_authenticate = $request->user()->tokens();

        $user_authenticate->delete();

        return ApiResponse::success(
            [],
            200,
            'Logout realizado com sucesso!.'
        );
    }

    private function validate_login(Request $request)
    {
        $validation = [
            'email' => 'email|required',
            'password' => 'required|min:6'
        ];

        $message = [
            'email.email' => 'O email deve ser um email válido.',
            'email.required' => 'O email é obrigatório.',
            'password.required' => 'A senha é obrigatória.',
            'password.min' => 'A senha deve ter no mínimo :min caracteres.',
        ];

        $request->validate($validation, $message);
    }
}