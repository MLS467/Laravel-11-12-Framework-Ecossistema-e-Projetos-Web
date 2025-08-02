<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{

    public function index()
    {
        // carregar usuario
        $id = session('user.id');
        $user = User::find($id)->toArray();

        // carregar as notas
        $notes = User::find($id)->notes()->get()->toArray();

        dd($user, $notes);

        return view('main');
    }

    public function newNote()
    {
        return "newNote";
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