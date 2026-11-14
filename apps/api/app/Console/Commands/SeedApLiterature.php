<?php

namespace App\Console\Commands;

use Database\Seeders\ApLiteratureSeeder;

/** Seed (or re-seed in place) the AP English Literature course. See SeedCurriculum. */
class SeedApLiterature extends SeedCurriculum
{
    protected $signature = 'course:seed-ap-literature'.self::OPTIONS;

    protected $description = 'Seed the AP English Literature course, owned by an existing teacher or by the demo account';

    protected function seeder(): string
    {
        return ApLiteratureSeeder::class;
    }
}
