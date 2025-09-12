<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

it('returns a successful response', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});
