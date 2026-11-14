<?php

namespace App\Console\Commands;

use Database\Seeders\ApChemistrySeeder;

/** Seed (or re-seed in place) the AP Chemistry course. See SeedCurriculum. */
class SeedApChemistry extends SeedCurriculum
{
    protected $signature = 'course:seed-ap-chemistry'.self::OPTIONS;

    protected $description = 'Seed the AP Chemistry course, owned by an existing teacher or by the demo account';

    protected function seeder(): string
    {
        return ApChemistrySeeder::class;
    }
}
