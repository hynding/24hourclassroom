<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile>
 */
class ProfileFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'bio' => fake()->sentence(),
            'school' => fake()->company(),
            'specialties' => null,
            'subjects' => ['math'],
            'grade_levels' => ['9-12'],
            'avatar_path' => null,
        ];
    }
}
