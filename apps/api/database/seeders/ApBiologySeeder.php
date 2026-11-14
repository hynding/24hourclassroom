<?php

namespace Database\Seeders;

use Database\Seeders\Curriculum\CurriculumSeeder;

/**
 * The AP Biology course: database/seeders/data/ap-biology, adapted from the
 * CC BY 4.0 OpenStax biology texts.
 *
 *   php artisan db:seed --class=ApBiologySeeder          (demo accounts)
 *   php artisan course:seed-ap-biology --teacher=EMAIL   (your own account)
 */
class ApBiologySeeder extends CurriculumSeeder
{
    /** course.yaml's `slug`: the course row's slug and every item's slug prefix. */
    public const COURSE_SLUG = 'apbio';

    public static function defaultDir(): string
    {
        return database_path('seeders/data/ap-biology');
    }
}
