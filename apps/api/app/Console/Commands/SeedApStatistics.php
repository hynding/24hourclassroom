<?php

namespace App\Console\Commands;

use Database\Seeders\ApStatisticsSeeder;

/** Seed (or re-seed in place) the AP Statistics course. See SeedCurriculum. */
class SeedApStatistics extends SeedCurriculum
{
    protected $signature = 'course:seed-ap-statistics'.self::OPTIONS;

    protected $description = 'Seed the AP Statistics course, owned by an existing teacher or by the demo account';

    protected function seeder(): string
    {
        return ApStatisticsSeeder::class;
    }
}
