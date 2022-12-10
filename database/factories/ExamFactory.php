<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Exam;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Exam>
 */
class ExamFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'date' => fake()->date(),
            'file' => fake()->uuid(),
            // 'user_id' => Exam::factory()->create()->id,
            'user_id' => fake()->numberBetween(1, 3),
            'laboratory_id' => fake()->numberBetween(1, 10),
        ];
    }
}
