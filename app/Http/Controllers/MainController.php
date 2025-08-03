<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

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
        try {
            $capture_id = Crypt::decrypt($id);
        } catch (DecryptException $e) {
            return redirect()->route('home');
        }
    }

    public function deleteNote($id)
    {
        try {
            $capture_id = Crypt::decrypt($id);
        } catch (DecryptException $e) {
            return redirect()->route('home');
        }
    }

    public function test_db(): void
    {
        try {
            DB::connection()->getPdo();
            echo "connection successfuly";
        } catch (\PDOException $e) {
            echo "connection failed $e";
        }
    }
}