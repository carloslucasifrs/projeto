<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Laboratoryexam;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Referencevalue>
 */
class ReferencevalueFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $age_min = fake()->numberBetween(0, 99);
        $value_min = fake()->numberBetween(0, 99);

        return [
            'rule' => fake()->word(),
            'biologic_sex' => 'masculino',
            'age_min' => $age_min,
            'age_max' => fake()->numberBetween($age_min, 100),
            'value_min' => $value_min,
            'value_max' => fake()->numberBetween($value_min, 100),
            // 'laboratoryexams_id' => Laboratoryexam::factory()->create()->id,
            'laboratoryexam_id' => fake()->numberBetween(4, 10),
        ];
    }
}
