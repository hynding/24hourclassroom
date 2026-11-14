<?php

namespace App\Console\Commands;

use Database\Seeders\ApWorldHistorySeeder;

/** Seed (or re-seed in place) the AP World History: Modern course. See SeedCurriculum. */
class SeedApWorldHistory extends SeedCurriculum
{
    protected $signature = 'course:seed-ap-world-history'.self::OPTIONS;

    protected $description = 'Seed the AP World History: Modern course, owned by an existing teacher or by the demo account';

    protected function seeder(): string
    {
        return ApWorldHistorySeeder::class;
    }
}
