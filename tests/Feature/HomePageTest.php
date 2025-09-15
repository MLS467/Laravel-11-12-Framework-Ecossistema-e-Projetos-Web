<?php

// HomePageTest

test('Testando a rota home', function () {
    $response = $this->get('/show-hash');

    expect($response->status())->toBe(200);
});