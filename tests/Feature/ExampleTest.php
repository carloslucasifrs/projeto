<?php

declare(strict_types=1);

namespace Tests\Feature;

it('test_the_application_returns_a_successful_response', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});
