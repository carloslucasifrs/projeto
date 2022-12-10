<?php

declare(strict_types=1);

namespace Tests\Feature\Auth;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('test_registration_screen_can_be_rendered', function () {
    $response = $this->get('/register');

    $response->assertStatus(200);
});

it('public function test_new_users_can_register', function () {
    $response = $this->post('/register', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
        'birth_date' => fake()->date(),
        'genre' => 'Transgênero',
        'biologic_sex' => 'Masculino',
        'nationality' => 'brasileira',
        'place_of_birth' => 'Brasil',
        'zipcode' => '99999999',
        'number' => '253a',
        'complement' => 'bloco A2 apto201',
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect(RouteServiceProvider::HOME);
});
