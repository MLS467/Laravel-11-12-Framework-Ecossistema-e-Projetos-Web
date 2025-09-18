<?php


//  beforeEach é executado antes de todos os testes 
//  posso atribuir valores antes de qualquer test
beforeEach(function () {
    $this->value = 10;
    $this->value_two = 20;
});

describe('Testes com hooks', function () {

    it('test one', function () {

        // echo "value -> {$this->value}" . PHP_EOL;
        // echo "value two -> {$this->value_two}" . PHP_EOL;

        expect($this->value)->toBe(10);
    });
});

//  afterEach é executado após todos os teste
//  pode ser usado para limpar dados definidos no beforeEach
afterEach(function () {
    unset($this->value);
    unset($this->value_two);
});