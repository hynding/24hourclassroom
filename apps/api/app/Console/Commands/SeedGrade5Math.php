<?php

namespace App\Console\Commands;

use Database\Seeders\Grade5MathSeeder;

/** Seed (or re-seed in place) the Grade 5 Math course. See SeedCurriculum. */
class SeedGrade5Math extends SeedCurriculum
{
    protected $signature = 'course:seed-grade-5-math'.self::OPTIONS;

    protected $description = 'Seed the Grade 5 Math course, owned by an existing teacher or by the demo account';

    protected function seeder(): string
    {
        return Grade5MathSeeder::class;
    }
}
