<?php

namespace Database\Seeders;

use Database\Seeders\Curriculum\CurriculumSeeder;

/**
 * The Geometry course: database/seeders/data/geometry, adapted from IM 9–12
 * Math by Illustrative Mathematics (CC BY 4.0).
 *
 *   php artisan db:seed --class=GeometrySeeder           (demo accounts)
 *   php artisan course:seed-geometry --teacher=EMAIL   (your own account)
 */
class GeometrySeeder extends CurriculumSeeder
{
    /** course.yaml's `slug`: the course row's slug and every item's slug prefix. */
    public const COURSE_SLUG = 'geo';

    public static function defaultDir(): string
    {
        return database_path('seeders/data/geometry');
    }
}
