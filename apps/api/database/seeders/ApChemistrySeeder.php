<?php

namespace Database\Seeders;

use Database\Seeders\Curriculum\CurriculumSeeder;

/**
 * The AP Chemistry course: database/seeders/data/ap-chemistry, original material
 * with public-domain sources only.
 *
 *   php artisan db:seed --class=ApChemistrySeeder           (demo accounts)
 *   php artisan course:seed-ap-chemistry --teacher=EMAIL   (your own account)
 */
class ApChemistrySeeder extends CurriculumSeeder
{
    /** course.yaml's `slug`: the course row's slug and every item's slug prefix. */
    public const COURSE_SLUG = 'apchem';

    public static function defaultDir(): string
    {
        return database_path('seeders/data/ap-chemistry');
    }
}
