<?php

it('renders the homepage', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});
