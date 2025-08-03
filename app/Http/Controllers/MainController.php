<?php

namespace App\Http\Controllers;

use App\Http\Services\Operation;
use App\Models\User;

class MainController extends Controller
{

    public function index()
    {
        // carregar usuario
        $id = session('user.id');

        // carregar as notas
        $notes = User::find($id)->notes()->get();

        // dd($user, $notes)
        return view('main', [
            'notes' => $notes,
        ]);
    }

    public function newNote()
    {
        return "newNote";
    }

    public function editNote($id)
    {
        $id_final = Operation::descrypt_id($id);
        dd($id_final);
    }

    public function deleteNote($id)
    {
        $id_final = Operation::descrypt_id($id);
        dd($id_final);
    }
}