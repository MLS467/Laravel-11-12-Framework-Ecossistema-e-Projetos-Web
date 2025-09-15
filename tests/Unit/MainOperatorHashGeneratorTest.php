<?php

use App\Services\MainOperations;
//MainOperatorHashGeneratorTest

test('Testando se tem a qtd caracteres', function () {
    expect(strlen(MainOperations::hash_generation()))->toEqual(32);
    expect(strlen(MainOperations::hash_generation(64)))->toEqual(64);
    expect(strlen(MainOperations::hash_generation(80)))->toEqual(80);
});