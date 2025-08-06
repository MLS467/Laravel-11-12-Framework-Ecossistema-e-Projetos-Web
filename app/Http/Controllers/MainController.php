<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController
{

    public function recebe_valor($value)
    {
        echo "Valor recebido ---> $value";
    }

    public function recebe_valor_opc($value = null)
    {
        echo "Valor recebido ---> $value";
    }

    public function recebe_valor_req(Request $request, $value1, $value2)
    {
        echo "Valor recebido ---> $value1, $value2";
        echo "<br>";
        echo $request;
    }
    public function recebe_valor2($value1, $value2)
    {
        echo "Valor recebido ---> $value1, $value2";
    }

    public function recebe_post(Request $request, $user_id, $post_id = null)
    {
        echo "Valor recebido ---> $user_id, $post_id";
        echo "<br>";
        echo $request;
    }
}