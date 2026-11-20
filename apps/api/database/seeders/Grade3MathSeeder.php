<?php

namespace Database\Seeders;

use Database\Seeders\Curriculum\CurriculumSeeder;

/**
 * The Grade 3 Math course: database/seeders/data/grade-3-math, adapted from
 * IM K-5 Math (first edition, CC BY 4.0), Grade 3. Its topic codes are
 * Common Core Grade 3 standards, so every test and material is tagged.
 *
 *   php artisan db:seed --class=Grade3MathSeeder             (demo accounts)
 *   php artisan course:seed-grade-3-math --teacher=EMAIL     (your own account)
 */
class Grade3MathSeeder extends CurriculumSeeder
{
    /** course.yaml's `slug`: the course row's slug and every item's slug prefix. */
    public const COURSE_SLUG = 'g3math';

    public static function defaultDir(): string
    {
        return database_path('seeders/data/grade-3-math');
    }
}
