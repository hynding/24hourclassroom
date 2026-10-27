<?php

namespace Database\Seeders;

use Database\Seeders\Curriculum\CurriculumSeeder;

/**
 * The Precalculus course: database/seeders/data/precalculus, original
 * material organised around the AP Precalculus Course and Exam Description.
 *
 *   php artisan db:seed --class=PrecalculusSeeder           (demo accounts)
 *   php artisan course:seed-precalculus --teacher=EMAIL   (your own account)
 */
class PrecalculusSeeder extends CurriculumSeeder
{
    /** course.yaml's `slug`: the course row's slug and every item's slug prefix. */
    public const COURSE_SLUG = 'precalc';

    public static function defaultDir(): string
    {
        return database_path('seeders/data/precalculus');
    }
}
