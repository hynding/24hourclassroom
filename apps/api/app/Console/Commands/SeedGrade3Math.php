<?php

namespace App\Console\Commands;

use Database\Seeders\Grade3MathSeeder;

/** Seed (or re-seed in place) the Grade 3 Math course. See SeedCurriculum. */
class SeedGrade3Math extends SeedCurriculum
{
    protected $signature = 'course:seed-grade-3-math'.self::OPTIONS;

    protected $description = 'Seed the Grade 3 Math course, owned by an existing teacher or by the demo account';

    protected function seeder(): string
    {
        return Grade3MathSeeder::class;
    }
}
