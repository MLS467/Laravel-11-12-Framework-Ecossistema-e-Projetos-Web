<?php

namespace App\Http\Controllers;

use App\Http\Services\Operation;
use App\Models\Note;
use App\Models\User;
use Illuminate\Http\Request;

class MainController extends Controller
{

    public function index()
    {
        // carregar usuario
        $id = session('user.id');

        // carregar as notas
        $notes = User::find($id)
            ->notes()
            ->whereNull('deleted_at')
            ->get();

        // dd($user, $notes)
        return view('main', [
            'notes' => $notes,
        ]);
    }

    public function newNote()
    {
        return view("new_note");
    }

    public function note_submit(Request $request)
    {
        // fazer a validação
        $request->validate(
            [
                'text_title' => 'required | min:3 | max:200',
                'text_note' => 'required | min:3 | max:3000'
            ],
            [
                'text_title.required' => "O título é obrigatório!",
                'text_tile.min' => "O título deve ter no mínimo :min caracteres!",
                'text_tile.max' => "O título deve ter no máximo :max caracteres!",
                'text_note.required' => "A nota é obrigatória!",
                'text_note.min' => "A nota deve ter no mínimo :min caracteres!",
                'text_note.max' => "A nota deve ter no máximo :max caracteres!",
            ]
        );

        // preencher os campos
        $id = session('user.id');

        // preenche os dados
        $note = new Note();
        $note->user_id = $id;
        $note->title = $request->text_title;
        $note->text = $request->text_note;

        // salva os dados
        $note->save();

        return redirect()->route('home');
    }

    public function editNote($id)
    {
        $id_final = Operation::descrypt_id($id);

        $nota = Note::find($id_final);

        return view('edit_note', ['nota' => $nota]);
    }

    public function editNoteSubmit(Request $request)
    {

        $request->validate(
            [
                'text_title' => 'required | min:3 | max:200',
                'text_note' => 'required | min:3 | max:3000'
            ],
            [
                'text_title.required' => "O título é obrigatório!",
                'text_tile.min' => "O título deve ter no mínimo :min caracteres!",
                'text_tile.max' => "O título deve ter no máximo :max caracteres!",
                'text_note.required' => "A nota é obrigatória!",
                'text_note.min' => "A nota deve ter no mínimo :min caracteres!",
                'text_note.max' => "A nota deve ter no máximo :max caracteres!",
            ]
        );

        if (!$request->note_id)
            return redirect()->route('home');

        $id = Operation::descrypt_id($request->note_id);

        $nota = Note::find($id);
        $nota->title = $request->text_title;
        $nota->text = $request->text_note;
        $nota->update();

        return redirect()->route('home');
    }

    public function deleteNote($id)
    {
        $id_final = Operation::descrypt_id($id);

        $nota = Note::find($id_final);

        return view('delete_note', ['nota' => $nota]);
    }

    public function deleteNoteConfirm($id)
    {
        $id_decrypt = Operation::descrypt_id($id);

        if (!$id_decrypt)
            return redirect()->route('home');

        // hard delete
        // Note::find($id_decrypt)->delete();

        // soft delete 
        // $nota = Note::find($id_decrypt);
        // $nota->deleted_at = date("Y/m/d H:i:s");
        // $nota->save();

        //soft delete usando a model
        // Note::find($id_decrypt)->delete();

        // com soft delete apagando fisicamente o registro
        Note::find($id_decrypt)->forceDelete();


        return redirect()
            ->route('home')
            ->with('sucesso', 'Excluido com sucesso!');
    }
}