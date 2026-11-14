<?php

namespace Database\Seeders;

use Database\Seeders\Curriculum\CurriculumSeeder;

/**
 * The AP U.S. History course: database/seeders/data/ap-us-history, original
 * material written around the College Board CED with public-domain primary
 * sources.
 *
 *   php artisan db:seed --class=ApUsHistorySeeder           (demo accounts)
 *   php artisan course:seed-ap-us-history --teacher=EMAIL   (your own account)
 */
class ApUsHistorySeeder extends CurriculumSeeder
{
    /** course.yaml's `slug`: the course row's slug and every item's slug prefix. */
    public const COURSE_SLUG = 'apush';

    public static function defaultDir(): string
    {
        return database_path('seeders/data/ap-us-history');
    }
}
