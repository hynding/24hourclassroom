<?php

namespace App\Console\Commands;

use Database\Seeders\PrecalculusSeeder;

/** Seed (or re-seed in place) the Precalculus course. See SeedCurriculum. */
class SeedPrecalculus extends SeedCurriculum
{
    protected $signature = 'course:seed-precalculus'.self::OPTIONS;

    protected $description = 'Seed the Precalculus course, owned by an existing teacher or by the demo account';

    protected function seeder(): string
    {
        return PrecalculusSeeder::class;
    }
}
