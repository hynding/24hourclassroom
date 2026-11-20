<?php

namespace Database\Seeders;

use Database\Seeders\Curriculum\CurriculumSeeder;

/**
 * The Grade 5 Math course: database/seeders/data/grade-5-math, adapted from
 * IM K-5 Math (first edition, CC BY 4.0), Grade 5. Its topic codes are
 * Common Core Grade 5 standards, so every test and material is tagged.
 *
 *   php artisan db:seed --class=Grade5MathSeeder             (demo accounts)
 *   php artisan course:seed-grade-5-math --teacher=EMAIL     (your own account)
 */
class Grade5MathSeeder extends CurriculumSeeder
{
    /** course.yaml's `slug`: the course row's slug and every item's slug prefix. */
    public const COURSE_SLUG = 'g5math';

    public static function defaultDir(): string
    {
        return database_path('seeders/data/grade-5-math');
    }
}
