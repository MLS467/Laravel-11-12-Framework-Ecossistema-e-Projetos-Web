<?php

namespace App\Http\Controllers;

use App\Models\Product;


class MainController extends Controller
{
    public function __invoke()
    {
        // pegando os dados Eloquent\Collection Object
        // $result = Product::all();

        // passando os dados do objeto para array
        // $result = Product::all()
        // ->toArray();

        // passando dados de array para um array de objetos stdClass Object
        // $result = $this->array_of_object(Product::all()->toArray());

        //  ordenando produtos pelo nome
        // $result = Product::orderBy('product_name', 'asc')
        //     ->get()
        //     ->toArray();

        // pegando os 3 primeiros produtos
        // $result = Product::limit(3)
        //     ->get()
        //     ->toArray();

        // pegando o produto por id
        // $result = Product::find(10)
        //     ->toArray();



        // $this->show_data($result);
    }
}
