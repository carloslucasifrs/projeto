<?php

declare(strict_types=1);

use App\Models\Laboratory;
use Illuminate\Http\Response;

test('access endpoint laboratory', function () {
    actingAs()
        ->getJson('/api/v1/laboratories')
        ->assertStatus(Response::HTTP_OK);
});

it('does not create a laboratory unprocessed validation', function () {
    actingAs()
        ->postJson('/api/v1/laboratories', [])
        ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
});

it('can create laboratory', function () {
    $attributes = Laboratory::factory()->raw();

    actingAs()
        ->postJson('/api/v1/laboratories', $attributes)
        ->assertStatus(Response::HTTP_CREATED);

    $this->assertDatabaseHas('laboratories', $attributes);
});

it('can fetch laboratory', function () {
    $laboratory = Laboratory::factory()->create();

    $response = actingAs()
        ->getJson("/api/v1/laboratories/{$laboratory->id}")
        ->assertStatus(Response::HTTP_OK)
        ->assertJsonStructure(
            [
                'data' => [
                    'id',
                    'name',
                    'phone',
                    'pattern',
                ],
            ]
        );
});

it('can update laboratory', function () {
    $laboratory = Laboratory::factory()->create();

    $payload = $payload = [
        'name' => fake()->unique()->sentence(3),
        'phone'  => '1234564',
    ];

    $response = actingAs()
        ->putJson("/api/v1/laboratories/{$laboratory->id}", $payload)
        ->assertStatus(Response::HTTP_OK)
        ->assertExactJson([
            'data' => [
                'id' => $laboratory->id,
                'name' => $payload['name'],
                'phone' => $payload['phone'],
                'pattern' => $laboratory->pattern,
            ],
        ]);

    // $this->assertDatabaseHas('laboratorys', $response->json('data'));
});

it('can delete a laboratory', function () {
    $count = Laboratory::all()->count();
    $laboratory = Laboratory::factory()->create();
    $response = actingAs()->deleteJson("/api/v1/laboratories/{$laboratory->id}")
        ->assertStatus(Response::HTTP_NO_CONTENT)
        ->assertNoContent();
    $this->assertCount($count++, Laboratory::all());
});
