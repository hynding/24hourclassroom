<?php

namespace App\Console\Commands;

use Database\Seeders\Algebra1Seeder;

/** Seed (or re-seed in place) the Algebra 1 course. See SeedCurriculum. */
class SeedAlgebra1 extends SeedCurriculum
{
    protected $signature = 'course:seed-algebra-1'.self::OPTIONS;

    protected $description = 'Seed the Algebra 1 course, owned by an existing teacher or by the demo account';

    protected function seeder(): string
    {
        return Algebra1Seeder::class;
    }
}
