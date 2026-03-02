<?php

test('the application returns a successful response', function () {
    $response = $this->get('/v1/items');

    $response->assertStatus(200);
});
