<?php

namespace App\Http\Controllers;

use App\Models\Product;

use function PHPSTORM_META\type;
use function PHPUnit\Framework\isObject;

class MainController extends Controller
{
    public function __invoke()
    {
        // $result = Product::where('price', '>=', 60)->first();

        // $result = Product::firstWhere('price', '>=', 60);

        // $name = strtoupper($result->product_name);
        // $price = strtoupper($result->price);
        // echo "Nome do produto <b>$name</b> e o preço é <b>$price</b>";


        // $result = Product::findOr(10, function () {
        //     return "NÃO FOI ENCONTRADO!";
        // });

        // if ($result instanceof Product) {
        //     $name = strtoupper($result->product_name);
        //     $price = strtoupper($result->price);
        //     echo "Nome do produto <b>$name</b> e o preço é <b>$price</b>";
        // } else
        //     echo $result;


        // $result = Product::findOrFail(110);
        // $name = strtoupper($result->product_name);
        // $price = strtoupper($result->price);
        // echo "Nome do produto <b>$name</b> e o preço é <b>$price</b>";

        $count = Product::count();
        $min = Product::min('price');
        $max = Product::max('price');
        $avg = Product::avg('price');
        $sum = Product::sum('price');

        $result = [
            'count' => $count,
            'min' => $min,
            'max' => $max,
            'avg' => $avg,
            'sum' => $sum,
        ];

        $this->show_data($result);
    }
}
