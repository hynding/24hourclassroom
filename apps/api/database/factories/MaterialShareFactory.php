<?php

namespace Database\Factories;

use App\Models\Material;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<\App\Models\MaterialShare> */
class MaterialShareFactory extends Factory
{
    public function definition(): array
    {
        return [
            'material_id' => Material::factory(),
            'user_id' => User::factory()->state(['role' => 'student']),
        ];
    }
}
