<?php

namespace Database\Factories;

use App\Enums\GradeLevel;
use App\Enums\Subject;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<\App\Models\Test> */
class TestFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory()->state(['role' => 'teacher']),
            'title' => fake()->sentence(3),
            'description' => fake()->sentence(),
            'subject' => fake()->randomElement(array_column(Subject::cases(), 'value')),
            'grade_level' => fake()->randomElement(array_column(GradeLevel::cases(), 'value')),
            'visibility' => 'private',
        ];
    }

    public function published(): static
    {
        return $this->state(fn () => ['visibility' => 'public', 'published_at' => now()]);
    }
}
