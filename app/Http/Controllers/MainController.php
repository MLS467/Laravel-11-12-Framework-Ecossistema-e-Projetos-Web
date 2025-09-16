<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Phone;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

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

    public function sameResult()
    {
        //  -------------------------------
        // USANDO ELOQUENT ORM
        //  -------------------------------

        // $client = Client::find(2);

        // $phone = Phone::where('client_id', $client->id)->get();

        // $client = Client::find(2);

        // $this->show_data($client->phones->toArray());

        // echo "<hr>";

        //------------------------------
        // USANDO QUERY BUILDER
        //------------------------------

        // $client_qb = DB::table('clients')->find(2);

        // $result = DB::table('phones')
        //     ->where('client_id', $client_qb->id)
        //     ->get();

        // $this->show_data($result->toArray());
    }


    public function collection()
    {
        //--------------------------------------
        // ELOQUENTE ORM - COLLECTIONS PARTE 1
        //--------------------------------------

        // TAKE pega os primeiros 5 clients 
        // $client = Client::take(5)->get();

        // foreach ($client as $key => $value) {
        //     echo  "chave: {$key}   name: {$value->client_name} <br>";
        // }


        // APPEND adiciona os campos só na coleção mas não da BD
        // $clients = Client::take(5)->get();
        // $clients->each->append(['name_upper', 'domain_email']);

        // foreach ($clients as $key => $value) {
        //     $value->name_upper = strtoupper($value->client_name);
        //     $value->domain_email = explode('@', $value->email)[1];
        // }

        // foreach ($clients as $key => $value) {
        //     echo "nome -> {$value->name_upper} | domínio de email -> {$value->domain_email}<br>";
        // }

        // CONTAINS verifica se contem o valor na coleção retornando TRUE e FALSE
        // $name = 'Mirela Alice Lopes';
        // $clients = Client::take(5)->get();
        // $result = $clients->contains('client_name', $name);
        // echo $result;


        // DIFF pega a diferença entre coleções
        $clients1 = Client::take(5)->get();
        $clients2 = Client::take(3)->get();

        $result = $clients1->diff($clients2);
        $this->show_data($result->toArray());
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