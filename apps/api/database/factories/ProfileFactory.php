<?php

namespace Database\Factories;

use App\Enums\GradeLevel;
use App\Enums\Subject;
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
        $subjects = array_column(Subject::cases(), 'value');
        $gradeLevels = array_column(GradeLevel::cases(), 'value');

        return [
            'bio' => fake()->sentence(),
            'school' => fake()->company(),
            'specialties' => null,
            'subjects' => fake()->randomElements($subjects, fake()->numberBetween(1, 3)),
            'grade_levels' => fake()->randomElements($gradeLevels, fake()->numberBetween(1, 2)),
            'avatar_path' => null,
        ];
    }
}
