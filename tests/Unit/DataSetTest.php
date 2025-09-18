<?php

describe('set data test fuction', function () {

    $data = [
        ["Ronaldo", 20],
        ["João", 18],
        ["Feijão", 19]
    ];

    it('test if is String', function ($name) {
        expect($name)->toBeString();
    })->with($data);

    it('test if greaterThan or equals', function ($name, $age) {
        expect($age)->toBeGreaterThanOrEqual(18);
    })->with($data);
});