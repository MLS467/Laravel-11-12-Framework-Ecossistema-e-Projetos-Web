<?php

namespace App\Services;



class MainOperations
{

    public static function hash_generation($num = 32): string
    {
        // gera um valor com letras e algarimos com 32 caracteres
        return bin2hex(random_bytes($num / 2));

        //simulando modificação errada no código
        // return bin2hex(random_bytes($num));
    }
}