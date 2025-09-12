<?php

namespace App\Http\Controllers;

use App\Models\Product;


class MainController extends Controller
{
    public function __invoke()
    {
        // usando cláusula where
        // $result = Product::where('price', '>=', 70)
        //     ->get()
        //     ->toArray();

        // pegando apenas a primeira recorrência (se não tiver quebra)
        // $result = Product::where('price', '>=', 70)
        //     ->first()
        //     ->toArray();

        // se não tiver como deve tratar
        // $result = Product::where('price', '>=', 170)
        //     ->firstOr(function () {
        //         return [];
        //     });

        // $result = !is_array($result) ? $result->toArray() : $result;

        /**
         * procuta o produto
         * muda o preço na memória sem salvar no BD
         * depois faz o refresh
         * e pega novamente o valor do BD
         * 
         *  $result = Product::find(10);
         *  echo $result->price;
         *  echo "<br>";

         *  $result->price = 200;
         *  echo $result->price;
         *  echo "<br>";

         *  $result->refresh();
         *  echo $result->price;
         *  echo "<br>";
         */


        // $this->show_data($result);
    }
}
