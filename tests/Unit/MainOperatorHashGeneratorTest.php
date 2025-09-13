<?php

use App\Services\MainOperations;
//MainOperatorHashGeneratorTest

test('Testando se tem 32 caracteres', function () {
    $tamanho_esperado = 32;

    $hash_gerada = MainOperations::hash_generation();

    $tamanho_da_hash = strlen($hash_gerada);

    expect($tamanho_da_hash)->toBe($tamanho_esperado);
});