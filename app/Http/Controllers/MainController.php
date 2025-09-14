<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Carbon\Carbon;

class MainController extends Controller
{
    public function __invoke()
    {
        // -------------------------------------
        //| DELETE - hard delete                |
        // -------------------------------------

        // Exclui o registro pelo id
        // $product = Product::find(10);
        // $product->delete();

        // Exclui todos os dados da tabela e reinicia a contagem do AI da tabela
        // Product::truncate();

        // Exclui vários dados de uma vez só
        // Product::destroy(1, 3, 5); // passando cada um dos valores

        // Exclui vários dados de uma vez só (usando array)
        // $ids = [8, 9, 10];
        // Product::destroy($ids);

        // Product::where('price', '>', 70)
        //     ->delete();

        // Product::where('id', 12)
        //     ->update([
        //         'deleted_at' => Carbon::now()
        //     ]);

        // $product = Product::find(18);
        // $product->deleted_at = Carbon::now();
        // $product->save();


        // -------------------------------------
        //| DELETE -  soft delete               |
        // -------------------------------------

        // $delete = Product::find(22);
        // $delete->delete();

        // pega os dados excluídos com soft delete
        // $product = Product::withTrashed()
        // ->find(22);

        // Restaura o valor do softDelete
        // $product->restore();

        // $this->show_data($product);
    }
}