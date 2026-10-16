<?php

namespace App\Console\Commands;

use Database\Seeders\Algebra2Seeder;

/** Seed (or re-seed in place) the Algebra 2 course. See SeedCurriculum. */
class SeedAlgebra2 extends SeedCurriculum
{
    protected $signature = 'course:seed-algebra-2'.self::OPTIONS;

    protected $description = 'Seed the Algebra 2 course, owned by an existing teacher or by the demo account';

    protected function seeder(): string
    {
        return Algebra2Seeder::class;
    }
}
