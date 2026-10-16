<?php

namespace Database\Seeders;

use Database\Seeders\Curriculum\CurriculumSeeder;

/**
 * The AP World History: Modern course: database/seeders/data/ap-world-history, original material
 * with public-domain sources only.
 *
 *   php artisan db:seed --class=ApWorldHistorySeeder           (demo accounts)
 *   php artisan course:seed-ap-world-history --teacher=EMAIL   (your own account)
 */
class ApWorldHistorySeeder extends CurriculumSeeder
{
    /** course.yaml's `slug`: the course row's slug and every item's slug prefix. */
    public const COURSE_SLUG = 'apworld';

    public static function defaultDir(): string
    {
        return database_path('seeders/data/ap-world-history');
    }
}
