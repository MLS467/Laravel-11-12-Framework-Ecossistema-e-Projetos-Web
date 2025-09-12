<?php

namespace App\Http\Controllers;

use TestModel;

class MainController extends Controller
{
    public function __invoke()
    {
        $products = TestModel::all()
            ->toArray();


        $this->show_data($products);
    }
}
