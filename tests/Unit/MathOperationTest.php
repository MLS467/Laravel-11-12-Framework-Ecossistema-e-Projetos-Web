<?php

use App\Services\MainOperations;

// MathOperationTest


// descripe eu posso fazer um conjunto de teste
describe('Test all Math operation', function () {

    // pode usar test ou it para definir o teste
    it('test sum', function () {
        $value1 = 10;
        $value2 = 5;
        $operation = 'add';
        $result = 15;

        $sum = MainOperations::MathOperation($value1, $value2, $operation);

        expect(intval($sum))->toBe($result);
    });

    it('test subtract', function () {
        $value1 = 10;
        $value2 = 5;
        $operation = 'subtract';
        $result = 5;

        $subtract = MainOperations::MathOperation($value1, $value2, $operation);

        expect(intval($subtract))->toBe($result);
    });

    it('test multiply', function () {
        $value1 = 10;
        $value2 = 5;
        $operation = 'multiply';
        $result = 50;

        $multiply = MainOperations::MathOperation($value1, $value2, $operation);

        expect(intval($multiply))->toBe($result);
    });

    it('test divide', function () {
        $value1 = 10;
        $value2 = 5;
        $operation = 'divide';
        $result = 2;

        $divide = MainOperations::MathOperation($value1, $value2, $operation);

        expect(intval($divide))->toBe($result);
    });

    it('divide by Zero', function () {
        $value1 = 10;
        $value2 = 0;
        $operation = 'divide';

        $divide = MainOperations::MathOperation($value1, $value2, $operation);

        expect($divide)->toEqual(floatval($value1));
    });

    it('operation erro', function () {
        $value1 = 10;
        $value2 = 10;
        $operation = 'teste';

        $divide = MainOperations::MathOperation($value1, $value2, $operation);

        expect($divide)->toBeString();
    });
});