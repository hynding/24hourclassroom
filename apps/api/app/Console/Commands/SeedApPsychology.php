<?php

namespace App\Console\Commands;

use Database\Seeders\ApPsychologySeeder;

/** Seed (or re-seed in place) the AP Psychology course. See SeedCurriculum. */
class SeedApPsychology extends SeedCurriculum
{
    protected $signature = 'course:seed-ap-psychology'.self::OPTIONS;

    protected $description = 'Seed the AP Psychology course, owned by an existing teacher or by the demo account';

    protected function seeder(): string
    {
        return ApPsychologySeeder::class;
    }
}
