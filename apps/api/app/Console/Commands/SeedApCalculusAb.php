<?php

namespace App\Console\Commands;

use Database\Seeders\ApCalculusAbSeeder;

/** Seed (or re-seed in place) the AP Calculus AB course. See SeedCurriculum. */
class SeedApCalculusAb extends SeedCurriculum
{
    protected $signature = 'course:seed-ap-calculus-ab'.self::OPTIONS;

    protected $description = 'Seed the AP Calculus AB course, owned by an existing teacher or by the demo account';

    protected function seeder(): string
    {
        return ApCalculusAbSeeder::class;
    }
}
