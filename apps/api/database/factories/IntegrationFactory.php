<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/** @extends Factory<\App\Models\Integration> */
class IntegrationFactory extends Factory
{
    public function definition(): array
    {
        // Never a real prefix shape a scanner would flag; the gateway is faked
        // in every test that reads this.
        $key = 'sk-ant-test-'.Str::random(20);

        return [
            'user_id' => User::factory()->state(['role' => 'teacher']),
            'anthropic_api_key' => $key,
            'anthropic_key_hint' => substr($key, -4),
            'anthropic_key_verified_at' => now(),
        ];
    }
}
