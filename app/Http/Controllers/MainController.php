<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    public function index()
    {
        $clients = DB::table('clients')->get();
        // $this->showRawTable($clients);
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