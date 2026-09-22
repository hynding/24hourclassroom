<?php

namespace Database\Factories;

use App\Enums\GradeLevel;
use App\Enums\Subject;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/** @extends Factory<\App\Models\Generation> */
class GenerationFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory()->state(['role' => 'teacher']),
            'title' => fake()->sentence(3),
            'subject' => fake()->randomElement(array_column(Subject::cases(), 'value')),
            'grade_level' => fake()->randomElement(array_column(GradeLevel::cases(), 'value')),
            'question_count' => 10,
            'material_ids' => [],
            'status' => 'running',
            'session_id' => 'sesn_'.Str::random(8),
            'started_at' => now(),
        ];
    }

    /** The row a create request died before creating a session for. */
    public function queued(): static
    {
        return $this->state(fn () => ['status' => 'queued', 'session_id' => null, 'started_at' => null]);
    }

    public function done(): static
    {
        return $this->state(fn () => ['status' => 'done', 'finished_at' => now()]);
    }

    public function failed(): static
    {
        return $this->state(fn () => ['status' => 'failed', 'finished_at' => now(), 'error' => 'Something went wrong.']);
    }
}
