<?php

namespace App\Services;

use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNumeric;

class MainOperations
{

    public static function hash_generation($num = 32): string
    {
        // gera um valor com letras e algarimos com 32 caracteres
        return bin2hex(random_bytes($num / 2));

        //simulando modificação errada no código
        // return bin2hex(random_bytes($num));
    }


    public static function MathOperation(float $valueOne, float $valueTwo, string $operation): float|string
    {
        if (!isset($valueOne) || !isset($valueTwo) || !isset($operation))
            return "Todos campos devem ser preenchidos!";

        $operation = strtolower($operation);

        $valueTwo = ($operation === 'divide' && $valueTwo === floatval(0) ?  1 : $valueTwo);

        return match ($operation) {
            'add' => $valueOne + $valueTwo,
            'subtract' => $valueOne - $valueTwo,
            'multiply' => $valueOne * $valueTwo,
            'divide' => $valueOne / $valueTwo,
            default => "Operação inexistente"
        };
    }
}