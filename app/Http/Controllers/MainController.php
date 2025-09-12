<?php

namespace App\Http\Controllers;

use App\Models\Product;


class MainController extends Controller
{
    public function __invoke()
    {

        $product = Product::find(10);
        $product->product_name = "MELANCIA";
        $product->price = 200;
        $product->save();

        $product->updateOrCreate(
            ['id' => '110'],
            ['product_name' => 'melancia']
        );
    }
}
