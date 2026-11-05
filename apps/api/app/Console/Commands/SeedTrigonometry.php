<?php

namespace App\Console\Commands;

use Database\Seeders\TrigonometrySeeder;

/** Seed (or re-seed in place) the Trigonometry course. See SeedCurriculum. */
class SeedTrigonometry extends SeedCurriculum
{
    protected $signature = 'course:seed-trigonometry'.self::OPTIONS;

    protected $description = 'Seed the Trigonometry course, owned by an existing teacher or by the demo account';

    protected function seeder(): string
    {
        return TrigonometrySeeder::class;
    }
}
