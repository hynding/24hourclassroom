<?php

namespace Database\Seeders;

use Database\Seeders\Curriculum\CurriculumSeeder;

/**
 * The AP Calculus BC course: database/seeders/data/ap-calculus-bc, original
 * material organised around the AP Calculus AB and BC Course and Exam
 * Description. It builds on AP Calculus AB (`builds_on`): its reuse weeks put
 * AB's own rows in the BC course, so a run seeds AB first for the same
 * teacher.
 *
 *   php artisan db:seed --class=ApCalculusBcSeeder             (demo accounts)
 *   php artisan course:seed-ap-calculus-bc --teacher=EMAIL    (your own account)
 */
class ApCalculusBcSeeder extends CurriculumSeeder
{
    /** course.yaml's `slug`: the course row's slug and every item's slug prefix. */
    public const COURSE_SLUG = 'apcalcbc';

    public static function defaultDir(): string
    {
        return database_path('seeders/data/ap-calculus-bc');
    }
}
