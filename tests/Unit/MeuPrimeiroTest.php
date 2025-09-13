<?php

test('example', function () {

    //primeira versão
    $value = true;

    //segunda versão
    // $value = false;

    expect($value)->toBeTrue();
});