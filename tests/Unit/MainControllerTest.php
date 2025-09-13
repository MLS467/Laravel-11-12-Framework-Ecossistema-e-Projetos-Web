<?php

use App\Http\Controllers\MainController;


test('class MainController | method index : return string', function () {
    $method_index = new MainController();

    $result = $method_index->index();

    expect($result)->toBeString();

    expect($result)->toEqual('Hello World Test');
});