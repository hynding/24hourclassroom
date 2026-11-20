<?php

namespace Database\Seeders;

use Database\Seeders\Curriculum\CurriculumSeeder;

/**
 * The AP Psychology course: database/seeders/data/ap-psychology, original
 * material organised around the AP Psychology Course and Exam
 * Description (the revised course, effective fall 2024).
 *
 *   php artisan db:seed --class=ApPsychologySeeder             (demo accounts)
 *   php artisan course:seed-ap-psychology --teacher=EMAIL    (your own account)
 */
class ApPsychologySeeder extends CurriculumSeeder
{
    /** course.yaml's `slug`: the course row's slug and every item's slug prefix. */
    public const COURSE_SLUG = 'appsych';

    public static function defaultDir(): string
    {
        return database_path('seeders/data/ap-psychology');
    }
}
