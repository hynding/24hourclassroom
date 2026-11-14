<?php

namespace App\Console\Commands;

use Database\Seeders\GeometrySeeder;

/** Seed (or re-seed in place) the Geometry course. See SeedCurriculum. */
class SeedGeometry extends SeedCurriculum
{
    protected $signature = 'course:seed-geometry'.self::OPTIONS;

    protected $description = 'Seed the Geometry course, owned by an existing teacher or by the demo account';

    protected function seeder(): string
    {
        return GeometrySeeder::class;
    }
}
