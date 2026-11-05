<?php

namespace Database\Seeders;

use Database\Seeders\Curriculum\CurriculumSeeder;

/**
 * The Trigonometry course: database/seeders/data/trigonometry, original
 * material organised around the Common Core trigonometry standards, from
 * right triangles through identities, vectors, complex numbers in
 * trigonometric form, polar and parametric equations.
 *
 *   php artisan db:seed --class=TrigonometrySeeder           (demo accounts)
 *   php artisan course:seed-trigonometry --teacher=EMAIL   (your own account)
 */
class TrigonometrySeeder extends CurriculumSeeder
{
    /** course.yaml's `slug`: the course row's slug and every item's slug prefix. */
    public const COURSE_SLUG = 'trig';

    public static function defaultDir(): string
    {
        return database_path('seeders/data/trigonometry');
    }
}
