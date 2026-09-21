<?php

namespace Database\Factories;

use App\Enums\GradeLevel;
use App\Enums\Subject;
use App\Models\Material;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/** @extends Factory<\App\Models\Material> */
class MaterialFactory extends Factory
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
            'original_name' => fake()->slug(3).'.pdf',
            // Filled in configure(): the author id is not resolved yet here.
            'path' => null,
            'mime_type' => 'application/pdf',
            'size_bytes' => 2048,
        ];
    }

    /**
     * `path` must live under materials/{author id}/, which is only knowable
     * once the nested User factory has been resolved to an id -- that happens
     * before afterMaking, and not before definition(). `??=` so an explicitly
     * passed path still wins.
     */
    public function configure(): static
    {
        return $this->afterMaking(function (Material $material) {
            $material->path ??= "materials/{$material->user_id}/".Str::random(40).'.pdf';
        });
    }

    public function published(): static
    {
        return $this->state(fn () => ['visibility' => 'public', 'published_at' => now()]);
    }
}
