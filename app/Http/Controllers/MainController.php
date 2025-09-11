<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Exception;

class MainController extends Controller
{
    public function index()
    {

        // INSERT

        $data = [
            'client_name' => 'batata 5223',
            'email' => 'batata@frita.com',
            'active' => rand(0, 1),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];

        try {

            // 1ª maneira de inserir dados usando Query Builder
            // try {
            //     DB::table('clients')
            //         ->insert($data);


            // 2ª maneira de inserir dados usando Query Builder
            // DB::table('clients')
            //     ->insert([
            //         'client_name' => 'batata insert direto',
            //         'email' => 'batata66@frita.com',
            //         'active' => rand(0, 1),
            //         'created_at' => Carbon::now(),
            //         'updated_at' => Carbon::now()
            //     ]);

            // 3ª maneira de inserir vários registros
            // DB::table('clients')
            //     ->insert(
            //         [
            //             [
            //                 'client_name' => 'batata insert primeiro',
            //                 'email' => 'batata666@frita.com',
            //                 'active' => rand(0, 1),
            //                 'created_at' => Carbon::now(),
            //                 'updated_at' => Carbon::now()
            //             ],
            //             [
            //                 'client_name' => 'batata insert segundo',
            //                 'email' => 'batat776@frita.com',
            //                 'active' => rand(0, 1),
            //                 'created_at' => Carbon::now(),
            //                 'updated_at' => Carbon::now()
            //             ]
            //         ]
            //     );


            // UPDATE
            // DB::table('clients')
            //     ->where('id', 1)
            //     ->update(
            //         [
            //             'client_name' => 'ALTERADO',
            //             'email' => 'batatA776@frita.com',
            //             'active' => rand(0, 1),
            //             'created_at' => Carbon::now(),
            //             'updated_at' => Carbon::now()
            //         ]
            //     );

            // DELETE HARD
            // $id = 2;

            // DB::table('phones')
            //     ->where('client_id', $id)
            //     ->delete();

            // DB::table('orders')
            //     ->where('client_id', $id)
            //     ->delete();

            // DB::table('clients')
            //     ->where('id', $id)
            //     ->delete();

            //DELETE SOFT
            //     $id = 3;

            //     DB::table('clients')
            //         ->where('id', $id)
            //         ->update([
            //             'deleted_at' => Carbon::now()
            //         ]);

            // $result = DB::table('clients')
            //     ->whereNotNull('deleted_at')
            //     ->get();
        } catch (Exception $error) {
            echo $error->getMessage();
        }



        // $this->showRawData($result);
    }

    private function showRawData($data)
    {
        echo '<pre>';
        print_r($data);
        echo '</pre>';
    }
    private function showRawTable($data)
    {
        echo '<table border="2">';
        echo '<thead>';
        foreach ($data[0] as $key => $val) {
            echo '<th>';
            echo $key;
            echo '</th>';
        }
        echo '</thead>';


        foreach ($data as $value) {

            echo '<tr>';
            foreach ($value as $val) {
                echo '<td>';
                echo $val;
                echo '</td>';
            }
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
    }
}