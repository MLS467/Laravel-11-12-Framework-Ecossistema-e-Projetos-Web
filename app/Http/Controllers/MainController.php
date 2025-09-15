<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Phone;
use App\Models\Product;

use function PHPUnit\Framework\isArray;

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

        // $result = Client::with('phone')->get();

        // foreach ($result as $key => $value) {
        //     echo "<br>";
        //     echo "<hr>";

        //     $phone = $value->phone != '' ? $value->phone->phone_number : '<b> Não informado </b>';
        //     $client_id = $value->phone != '' ? $value->phone->client_id : '<b> Não informado </b>';

        //     echo "
        //     id =>{$value->id} 
        //     Nome do cliente => {$value->client_name} 
        //     e o telefone  {$phone} 
        //     id_cli_rel => {$client_id}
        //     ";
        // }
    }

    public function one_to_many()
    {
        // pegando o cliente e depois o telefone
        // $client = Client::find(15);
        // $phones = $client->phones;

        // echo
        // "
        // <hr>
        // identificador do cliente: #{$client->id}
        // <br>
        // Nome do cliente: {$client->client_name}
        // <br>
        // ";

        // $count = 0;
        // foreach ($phones as $key => $value) {
        //     echo '<br>';
        //     $count++;
        //     echo
        //     "
        //     {$count}º Telefone -> {$value->phone_number} 
        //     ";
        // }
        // echo "<hr>";


        // pegando o cliente e o telefone juntos com (with)
        // $client = Client::with('phones')->find(2);


        $clients = Client::with('phones')->get();
        $this->showDataWithHTML($clients);
    }

    public function belongsTo()
    {
        //    --------------------------
        //    | RELAÇÕES INVERSAS
        //    --------------------------
        // vamos pegar no model de telefone e descobrir qual cliente está relacionado

        // $phone = Phone::find(10);
        // $client = $phone->client;

        // echo "<b>Nome: </b> {$client->client_name} | <b>Telefone: </b> {$phone->phone_number}";

        $phones = Phone::with('client')->get();

        foreach ($phones as $phone) {
            echo "<hr><b>Nome: </b> {$phone->client->client_name} | <b>Telefone: </b> {$phone->phone_number} <br>";
        }


        // $client = Phone::with('client')->find(15);

        // $this->show_data($client->toArray());
    }

    public function belongsToMany()
    {
        // buscando quais produtos determinado cliente comprou
        // $result = Client::with('products')->find(10);

        // echo "<h1>{$result->client_name}</h1>";
        // echo "<h3> Produtos: </h3>";

        // foreach ($result->products as $key => $value) {
        //     echo "chave->{$key} name->{$value->product_name}<br>";
        // }


        // buscando quais clientes compraram determinado produto
        // $result = Product::with('clients')->find(10);

        // $this->show_data($result->toArray());
    }

    public function moreQueryBuilder()
    {
        $client = Client::find(10);

        // $products = $client->products()->distinct()->get(['product_name', 'price']);
        $products = $client->products()
            ->where('products.id', '>', 10)
            ->distinct()
            ->orderBy('products.id')
            ->get();

        $this->showArrayLoop($products);
    }


    private function showArrayLoop($datas)
    {
        echo '<table border="2">';

        echo '<thead>';
        echo "<tr>";
        foreach ($datas->toArray()[0] as $key => $data) {
            echo "<th>";
            echo  $key;
            echo "</th>";
        }
        echo "</tr>";
        echo "<tbody>";
        foreach ($datas as $key => $value) {
            echo "<tr>";
            foreach ($value->toArray() as $key => $v) {
                echo "<td>";
                echo  $value[$key];
                echo "</td>";
            }
            echo "<tr>";
        }
        echo "</tbody>";
        echo '</thead>';
    }

    private function showDataWithHTML($client)
    {
        foreach ($client as $key => $value) {
            echo
            "
        <hr>
        identificador do cliente: #{$value->id}
        <br>
        Nome do cliente: {$value->client_name}
        <br>
        ";

            $count = 0;
            foreach ($value->phones as $key => $value) {
                echo '<br>';
                $count++;
                echo
                "
                {$count}º Telefone -> {$value->phone_number} 
                ";
            }
        }
        echo "<hr>";
    }
}