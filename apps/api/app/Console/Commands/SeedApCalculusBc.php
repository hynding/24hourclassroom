<?php

namespace App\Console\Commands;

use Database\Seeders\ApCalculusBcSeeder;

/** Seed (or re-seed in place) the AP Calculus BC course (and the AB course it builds on). See SeedCurriculum. */
class SeedApCalculusBc extends SeedCurriculum
{
    protected $signature = 'course:seed-ap-calculus-bc'.self::OPTIONS;

    protected $description = 'Seed the AP Calculus BC course (and the AB course it builds on), owned by an existing teacher or by the demo account';

    protected function seeder(): string
    {
        return ApCalculusBcSeeder::class;
    }
}
