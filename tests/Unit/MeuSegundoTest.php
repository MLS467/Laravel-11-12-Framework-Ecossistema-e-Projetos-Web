<?php

test('o meu segundo teste', function () {

    $name = 'joão';

    expect($name)->toBeString();
});