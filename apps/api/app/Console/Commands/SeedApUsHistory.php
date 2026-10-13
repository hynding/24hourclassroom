<?php

namespace App\Console\Commands;

use Database\Seeders\ApUsHistorySeeder;

/** Seed (or re-seed in place) the AP U.S. History course. See SeedCurriculum. */
class SeedApUsHistory extends SeedCurriculum
{
    protected $signature = 'course:seed-ap-us-history'.self::OPTIONS;

    protected $description = 'Seed the AP U.S. History course, owned by an existing teacher or by the demo account';

    protected function seeder(): string
    {
        return ApUsHistorySeeder::class;
    }
}
