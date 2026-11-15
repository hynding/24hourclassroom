<?php

namespace Database\Seeders;

use Database\Seeders\Curriculum\CurriculumSeeder;

/**
 * The AP Statistics course: database/seeders/data/ap-statistics, original
 * material organised around the AP Statistics Course and Exam
 * Description (the redesigned course, effective fall 2026).
 *
 *   php artisan db:seed --class=ApStatisticsSeeder             (demo accounts)
 *   php artisan course:seed-ap-statistics --teacher=EMAIL    (your own account)
 */
class ApStatisticsSeeder extends CurriculumSeeder
{
    /** course.yaml's `slug`: the course row's slug and every item's slug prefix. */
    public const COURSE_SLUG = 'apstats';

    public static function defaultDir(): string
    {
        return database_path('seeders/data/ap-statistics');
    }
}
