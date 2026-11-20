<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/** @extends Factory<\App\Models\Figure> */
class FigureFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'path' => 'figures/'.Str::random(40).'.png',
            'mime_type' => 'image/png',
            'size_bytes' => 68,
        ];
    }
}
