<?php

namespace App\Http\Controllers;

abstract class Controller
{
    public function show_data($data): void
    {
        echo '<pre>';
        print_r($data);
        echo '</pre>';
    }

    public function array_of_object($data)
    {
        $tmp = [];

        foreach ($data as $key => $value) {
            $tmp[] = (object) $value;
        }

        return $tmp;
    }
}
