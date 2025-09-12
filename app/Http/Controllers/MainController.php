<?php

namespace App\Http\Controllers;

use App\Models\Product;


class MainController extends Controller
{
    public function __invoke()
    {
        // formas de inserir dados no banco

        // $product = new Product();
        // $product->price = 50;
        // $product->product_name = 'produto 1';
        // $product->save();

        // Product::create([
        //     'product_name' => 'Fogão',
        //     'price' => 500
        // ]);

        Product::insert(
            [
                [
                    'product_name' => 'product 500',
                    'price' => 500
                ],
                [
                    'product_name' => 'product 600',
                    'price' => 600
                ],
                [
                    'product_name' => 'product 700',
                    'price' => 700
                ]
            ]
        );
    }
}
