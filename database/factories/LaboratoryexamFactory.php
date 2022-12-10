<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Laboratoryexam>
 */
class LaboratoryexamFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'exam' => fake()->unique()->sentence(3),
            'description' => fake()->paragraph(3),
            'material' => fake()->word(),
            'method' => fake()->word(),
            'use' => fake()->paragraph(),
            'bibliography' => fake()->text(50),
        ];
    }
}
