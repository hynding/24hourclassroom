<?php

namespace App\Console\Commands;

use Database\Seeders\ApBiologySeeder;

/** Seed (or re-seed in place) the AP Biology course. See SeedCurriculum. */
class SeedApBiology extends SeedCurriculum
{
    protected $signature = 'course:seed-ap-biology'.self::OPTIONS;

    protected $description = 'Seed the AP Biology course, owned by an existing teacher or by the demo account';

    protected function seeder(): string
    {
        return ApBiologySeeder::class;
    }
}
