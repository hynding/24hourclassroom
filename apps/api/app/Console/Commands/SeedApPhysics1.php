<?php

namespace App\Console\Commands;

use Database\Seeders\ApPhysics1Seeder;

/** Seed (or re-seed in place) the AP Physics 1 course. See SeedCurriculum. */
class SeedApPhysics1 extends SeedCurriculum
{
    protected $signature = 'course:seed-ap-physics-1'.self::OPTIONS;

    protected $description = 'Seed the AP Physics 1 course, owned by an existing teacher or by the demo account';

    protected function seeder(): string
    {
        return ApPhysics1Seeder::class;
    }
}
