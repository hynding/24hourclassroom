<?php

namespace Database\Seeders;

use Database\Seeders\Curriculum\CurriculumSeeder;

/**
 * The Chemistry course: database/seeders/data/chemistry, original material
 * with public-domain sources only.
 *
 *   php artisan db:seed --class=ChemistrySeeder           (demo accounts)
 *   php artisan course:seed-chemistry --teacher=EMAIL   (your own account)
 */
class ChemistrySeeder extends CurriculumSeeder
{
    /** course.yaml's `slug`: the course row's slug and every item's slug prefix. */
    public const COURSE_SLUG = 'chem';

    public static function defaultDir(): string
    {
        return database_path('seeders/data/chemistry');
    }
}
