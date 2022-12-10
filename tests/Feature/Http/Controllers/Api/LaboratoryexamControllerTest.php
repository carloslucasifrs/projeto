<?php

declare(strict_types=1);

use App\Models\Laboratoryexam;
use Illuminate\Http\Response;

test('access endpoint labratoryexams', function () {
    actingAs()
        ->getJson('/api/v1/laboratoryexams')
        ->assertStatus(Response::HTTP_OK);
});

it('does not create a laboratory  exam not name field', function () {
    actingAs()
        ->postJson('/api/v1/laboratoryexams', [])
        ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
});

it('can create laboratory exam', function () {
    $attributes = Laboratoryexam::factory()->raw();

    actingAs()
        ->postJson('/api/v1/laboratoryexams', $attributes)
        ->assertStatus(Response::HTTP_CREATED);

    $this->assertDatabaseHas('laboratoryexams', $attributes);
});

it('can fetch laboratory exam', function () {
    $laboratoryExam = Laboratoryexam::factory()->create();

    $response = actingAs()
        ->getJson("/api/v1/laboratoryexams/{$laboratoryExam->id}")
        ->assertStatus(Response::HTTP_OK)
        ->assertJsonStructure(
            [
                'data' => [
                    'id',
                    'exam',
                    'description',
                    'material',
                    'method',
                    'use',
                    'bibliography',
                    'referencevalues' => [],
                ],
            ]
        );
});

it('can update a laboratoryexam', function () {
    $laboratoryExam = Laboratoryexam::factory()->create();

    $payload = $payload = [
        'exam' => fake()->unique()->sentence(3),
        'description'  => fake()->paragraph(3),
    ];

    $response = actingAs()
        ->putJson("/api/v1/laboratoryexams/{$laboratoryExam->id}", $payload)
        ->assertStatus(Response::HTTP_OK)
        ->assertExactJson([
            'data' => [
                'id' => $laboratoryExam->id,
                'exam' => $payload['exam'],
                'description' => $payload['description'],
                'material' => $laboratoryExam->material,
                'method' => $laboratoryExam->method,
                'use' => $laboratoryExam->use,
                'bibliography' => $laboratoryExam->bibliography,
                'referencevalues' => [],
            ],
        ]);

    // $this->assertDatabaseHas('laboratoryexams', $response->json('data'));
});

it('can delete a laboratory exam', function () {
    $count = Laboratoryexam::all()->count();
    $laboratoryExam = Laboratoryexam::factory()->create();
    $response = actingAs()->deleteJson("/api/v1/laboratoryexams/{$laboratoryExam->id}")
        ->assertStatus(Response::HTTP_NO_CONTENT)
        ->assertNoContent();
    $this->assertCount($count++, Laboratoryexam::all());
});
