<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Product;
use Carbon\Carbon;

class MainController extends Controller
{
    public function __invoke()
    {
        echo "ELOQUENT RELATIONSHIPS";
    }

    public function one_to_one()
    {
        //buscando o telefone de um cliente
        // $client_phone = Client::find(12)
        //     ->phone;

        // buscando o cliente e usando seu telefone
        // $client = Client::find(12);
        // $client_name = $client->client_name;
        // $phone = $client->phone->phone_number;

        // $test = [
        //     'Nome do cliente' => $client_name,
        //     'Numero do telefone' => $phone
        // ];

        // pega os dados do cliente e seus respectivos telefones
        // $client = Client::with('phone')->find(12);

        $result = Client::with('phone')->get();

        foreach ($result as $key => $value) {
            echo "<br>";
            echo "<hr>";

            $phone = $value->phone != '' ? $value->phone->phone_number : '<b> Não informado </b>';
            $client_id = $value->phone != '' ? $value->phone->client_id : '<b> Não informado </b>';

            echo "
            id =>{$value->id} 
            Nome do cliente => {$value->client_name} 
            e o telefone  {$phone} 
            id_cli_rel => {$client_id}
            ";
        }
    }
}