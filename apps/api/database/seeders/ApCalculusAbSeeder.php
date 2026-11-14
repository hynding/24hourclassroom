<?php

namespace Database\Seeders;

use Database\Seeders\Curriculum\CurriculumSeeder;

/**
 * The AP Calculus AB course: database/seeders/data/ap-calculus-ab, original
 * material organised around the AP Calculus AB and BC Course and Exam
 * Description (AB topics only).
 *
 *   php artisan db:seed --class=ApCalculusAbSeeder             (demo accounts)
 *   php artisan course:seed-ap-calculus-ab --teacher=EMAIL    (your own account)
 */
class ApCalculusAbSeeder extends CurriculumSeeder
{
    /** course.yaml's `slug`: the course row's slug and every item's slug prefix. */
    public const COURSE_SLUG = 'apcalcab';

    public static function defaultDir(): string
    {
        return database_path('seeders/data/ap-calculus-ab');
    }
}
