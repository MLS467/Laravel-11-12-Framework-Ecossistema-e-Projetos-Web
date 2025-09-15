<?php

// ExpectationAPITest

describe('Test Expectation function (API)', function () {


    it("Test the toBe() function", function () {
        $value = 10;

        // valida se o valor é 10
        expect($value)->toBe(10);


        // valida se o é inteiro eo valor é igual 10
        expect($value)
            ->toBeInt()
            ->toBe(10);
    });


    it('test the toBeTrue() and toBeFalse() function', function () {
        $value1 = true;
        $value2 = false;

        // testa se o valor é true 
        expect($value1)->toBeTrue();

        // testa se o valor é false 
        expect($value2)->toBeFalse();
    });


    it('test the toBeNull() function', function () {

        $value = null;

        // testando se o valor é null
        expect($value)->toBeNull();
    });


    it('test the toBeEmpty() function', function () {

        $empty = '';

        // testando se o valor é empty
        expect($empty)->toBeEmpty();
    });



    it('test the toBeArray() function', function () {
        $value = [];

        // testando se o valor é um array
        expect($value)->toBeArray();
    });



    it('test toBeIn() function', function () {
        $values = [10, 20, 30, 40, 50];
        $value_test = 50;

        // teste se o valor no expect tem no array do tobein
        expect($value_test)->toBeIn($values);
    });


    it('test toBeJson', function () {
        $json = json_encode(
            [
                'nome' => 'Maisson Leal',
                'idade' => 30
            ]
        );

        // testando se o valor é um json
        expect($json)->toBeJson();
    });


    it('test toMatch function', function () {
        $value = "hello world";

        // testando usando regex
        expect($value)->toMatch('/hello/');
    });


    it('test toUpperCase function', function () {

        $value = "EU";

        expect($value)->toBeUppercase();
    });
});