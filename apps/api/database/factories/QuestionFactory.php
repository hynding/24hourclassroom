<?php

namespace Database\Factories;

use App\Models\Test;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<\App\Models\Question> */
class QuestionFactory extends Factory
{
    public function definition(): array
    {
        return [
            'test_id' => Test::factory(),
            'position' => 0,
            'type' => 'multiple_choice',
            'prompt' => fake()->sentence().'?',
            'options' => ['Alpha', 'Beta', 'Gamma', 'Delta'],
            'answer' => 0,
            'points' => 1,
            'partial_credit' => false,
            'explanation' => null,
        ];
    }

    public function multiSelect(bool $partial = false): static
    {
        return $this->state(fn () => ['type' => 'multi_select', 'options' => ['A', 'B', 'C', 'D'], 'answer' => [0, 2], 'partial_credit' => $partial]);
    }

    public function trueFalse(): static
    {
        return $this->state(fn () => ['type' => 'true_false', 'options' => null, 'answer' => true]);
    }

    public function shortAnswer(): static
    {
        return $this->state(fn () => ['type' => 'short_answer', 'options' => null, 'answer' => 'photosynthesis']);
    }

    public function numeric(float $value = 42, float $tolerance = 0): static
    {
        return $this->state(fn () => ['type' => 'numeric', 'options' => null, 'answer' => ['value' => $value, 'tolerance' => $tolerance]]);
    }
}
