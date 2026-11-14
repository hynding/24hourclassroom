<?php

namespace App\Console\Commands;

use Database\Seeders\ChemistrySeeder;

/** Seed (or re-seed in place) the Chemistry course. See SeedCurriculum. */
class SeedChemistry extends SeedCurriculum
{
    protected $signature = 'course:seed-chemistry'.self::OPTIONS;

    protected $description = 'Seed the Chemistry course, owned by an existing teacher or by the demo account';

    protected function seeder(): string
    {
        return ChemistrySeeder::class;
    }
}
