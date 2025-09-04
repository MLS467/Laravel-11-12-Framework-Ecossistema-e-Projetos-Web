<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    public function index()
    {

        // pegando todos dados de uma tabela retornando um obj
        // $clients = DB::table('clients')->get();


        // pegando todos dados de uma tabela retornando um array
        // $clients = DB::table('clients')->get()->toArray();


        // transformando em um array de arrays
        // $clients = DB::table('clients')->get()->map(function ($item) {
        //     return (array) $item;
        // });


        // pegando algumas colunas 
        // $clients = DB::table('clients')
        //     ->get(['client_name', 'email']);


        // pegando primeiro registro de algumas colunas 
        // $clients = DB::table('clients')
        //     ->get(['client_name', 'email'])
        //     ->first();


        // pegando último registro de algumas colunas 
        // $clients = DB::table('clients')
        //     ->get(['client_name', 'email'])
        //     ->last();


        // pegando um valor específico
        // $clients = DB::table('clients')->find(10);


        // pegando um valor específico com where
        // $clients = DB::table('clients')
        //     ->where('id', 10)
        //     ->get();


        // pegando todos registro com apenas uma coluna com select
        // se pegar com where pode filtrar
        // $clients = DB::table('clients')
        //     ->select('client_name')
        //     ->where('id', 10)
        //     ->get();


        // pegando todos os valores de uma coluna e transformando em array
        // $clients = DB::table('clients')
        //     ->where('id', '>', 400)
        //     ->pluck('email');


        // fazendo query com multiplos where (and)
        // $clients = DB::table('clients')
        //     ->where('id', '>', 10)
        //     ->where('client_name', 'like', 'a%')
        //     ->get();



        // fazendo query com multiplos where (or)
        // $clients = DB::table('clients')
        //     ->where('id', '>', 450)
        //     ->orWhere('client_name', 'like', 'a%')
        //     ->get();


        // fazendo query com multiplos where usando where com array equivale a o and
        // $clients = DB::table('clients')->where([
        //     ['id', '>', 400],
        //     ['client_name', 'like', 'a%']
        // ])->get();


        // fazendo query complexa
        // $clients = DB::table('clients')
        //     ->where('id', '>', 450)
        //     ->orWhere(function (Builder $item) {
        //         $item->where('client_name', 'like', 'a%');
        //     })->get();



        // $this->showRawData($clients);
    }

    private function showRawData($data)
    {
        echo '<pre>';
        print_r($data);
        echo '</pre>';
    }
    private function showRawTable($data)
    {
        echo '<table border="2">';
        echo '<thead>';
        foreach ($data[0] as $key => $val) {
            echo '<th>';
            echo $key;
            echo '</th>';
        }
        echo '</thead>';


        foreach ($data as $value) {

            echo '<tr>';
            foreach ($value as $val) {
                echo '<td>';
                echo $val;
                echo '</td>';
            }
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
    }
}