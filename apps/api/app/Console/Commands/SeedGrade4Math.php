<?php

namespace App\Console\Commands;

use Database\Seeders\Grade4MathSeeder;

/** Seed (or re-seed in place) the Grade 4 Math course. See SeedCurriculum. */
class SeedGrade4Math extends SeedCurriculum
{
    protected $signature = 'course:seed-grade-4-math'.self::OPTIONS;

    protected $description = 'Seed the Grade 4 Math course, owned by an existing teacher or by the demo account';

    protected function seeder(): string
    {
        return Grade4MathSeeder::class;
    }
}
