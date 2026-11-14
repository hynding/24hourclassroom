<?php

namespace Database\Seeders;

use Database\Seeders\Curriculum\CurriculumSeeder;

/**
 * The Algebra 1 course: database/seeders/data/algebra-1, adapted from IM 9–12
 * Math by Illustrative Mathematics (CC BY 4.0).
 *
 *   php artisan db:seed --class=Algebra1Seeder           (demo accounts)
 *   php artisan course:seed-algebra-1 --teacher=EMAIL   (your own account)
 */
class Algebra1Seeder extends CurriculumSeeder
{
    /** course.yaml's `slug`: the course row's slug and every item's slug prefix. */
    public const COURSE_SLUG = 'alg1';

    public static function defaultDir(): string
    {
        return database_path('seeders/data/algebra-1');
    }
}
