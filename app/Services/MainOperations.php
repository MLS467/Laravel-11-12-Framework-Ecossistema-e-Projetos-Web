<?php

namespace App\Services;



class MainOperations
{

    public static function hash_generation(): string
    {
        // gera um valor com letras e algarimos com 32 caracteres
        return bin2hex(random_bytes(16));
    }
}