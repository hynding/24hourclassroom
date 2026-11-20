<?php

namespace Database\Seeders;

use Database\Seeders\Curriculum\CurriculumSeeder;

/**
 * The Grade 4 Math course: database/seeders/data/grade-4-math, adapted from
 * IM K-5 Math (first edition, CC BY 4.0), Grade 4. Its topic codes are
 * Common Core Grade 4 standards, so every test and material is tagged.
 *
 *   php artisan db:seed --class=Grade4MathSeeder             (demo accounts)
 *   php artisan course:seed-grade-4-math --teacher=EMAIL     (your own account)
 */
class Grade4MathSeeder extends CurriculumSeeder
{
    /** course.yaml's `slug`: the course row's slug and every item's slug prefix. */
    public const COURSE_SLUG = 'g4math';

    public static function defaultDir(): string
    {
        return database_path('seeders/data/grade-4-math');
    }
}
