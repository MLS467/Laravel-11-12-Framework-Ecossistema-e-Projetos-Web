<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    public function index()
    {

        // pegando todos dados de uma tabela retornando um obj
        // $result = DB::table('clients')->get();


        // pegando todos dados de uma tabela retornando um array
        // $result = DB::table('clients')->get()->toArray();


        // transformando em um array de arrays
        // $result = DB::table('clients')->get()->map(function ($item) {
        //     return (array) $item;
        // });


        // pegando algumas colunas 
        // $result = DB::table('clients')
        //     ->get(['client_name', 'email']);


        // pegando primeiro registro de algumas colunas 
        // $result = DB::table('clients')
        //     ->get(['client_name', 'email'])
        //     ->first();


        // pegando último registro de algumas colunas 
        // $result = DB::table('clients')
        //     ->get(['client_name', 'email'])
        //     ->last();


        // pegando um valor específico
        // $result = DB::table('clients')->find(10);


        // pegando um valor específico com where
        // $result = DB::table('clients')
        //     ->where('id', 10)
        //     ->get();


        // pegando todos registro com apenas uma coluna com select
        // se pegar com where pode filtrar
        // $result = DB::table('clients')
        //     ->select('client_name')
        //     ->where('id', 10)
        //     ->get();


        // pegando todos os valores de uma coluna e transformando em array
        // $result = DB::table('clients')
        //     ->where('id', '>', 400)
        //     ->pluck('email');


        // fazendo query com multiplos where (and)
        // $result = DB::table('clients')
        //     ->where('id', '>', 10)
        //     ->where('client_name', 'like', 'a%')
        //     ->get();



        // fazendo query com multiplos where (or)
        // $result = DB::table('clients')
        //     ->where('id', '>', 450)
        //     ->orWhere('client_name', 'like', 'a%')
        //     ->get();


        // fazendo query com multiplos where usando where com array equivale a o and
        // $result = DB::table('clients')->where([
        //     ['id', '>', 400],
        //     ['client_name', 'like', 'a%']
        // ])->get();


        // fazendo query complexa
        // $result = DB::table('clients')
        //     ->where('id', '>', 450)
        //     ->orWhere(function (Builder $item) {
        //         $item->where('client_name', 'like', 'a%');
        //     })->get();



        // pegar todos os produtos que não começam com a letra M not like
        // $result = DB::table('products')
        //     ->where('product_name', 'not like', 'M%')
        //     ->get();


        // pegar todos os produtos que não começam com a letra M whereNot
        // $result = DB::table('products')
        //     ->whereNot('product_name', 'like', 'M%') // esse valor começa com M (eu não quero)
        //     ->get();


        // peganto todos registro que tem tr no nome ou no email com whereAny
        // $result = DB::table('clients')
        //     ->whereAny(['client_name', 'email'], 'like', '%tr%')
        //     ->get();


        // pegando valores por intervalo usando whereBetween
        // $result = DB::table('products')
        //     ->whereBetween('price', [60000, 100000])
        //     ->get();


        // pegando valores fora intervalo usando whereNotBetween
        // $result = DB::table('products')
        //     ->whereNotBetween('price', [60000, 100000])
        //     ->get();



        // $this->showRawData($result);
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