<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database. Re-runnable: the demo user is
     * looked up by email, and the course seeders update in place.
     */
    public function run(): void
    {
        // The factory's own random email is in raw(); name it here too, or
        // firstOrCreate's array_merge lets the random one win on create.
        User::firstOrCreate(
            ['email' => 'test@example.com'],
            User::factory()->raw(['name' => 'Test User', 'email' => 'test@example.com']),
        );

        $this->call([
            ApBiologySeeder::class,
            ApUsHistorySeeder::class,
            ApLiteratureSeeder::class,
            Algebra1Seeder::class,
            GeometrySeeder::class,
            Algebra2Seeder::class,
            PrecalculusSeeder::class,
            ChemistrySeeder::class,
            ApChemistrySeeder::class,
            ApWorldHistorySeeder::class,
        ]);
    }
}
