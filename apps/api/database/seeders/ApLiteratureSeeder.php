<?php

namespace Database\Seeders;

use Database\Seeders\Curriculum\CurriculumSeeder;

/**
 * The AP English Literature and Composition course:
 * database/seeders/data/ap-literature, original writing around public-domain
 * texts. Organised by CED skill rather than numbered topic (`skills` in its
 * course.yaml; see Curriculum\Course::bySkill), and linted by its own
 * ApLiterature\Lint for the public-domain cutoff and passage sets.
 *
 *   php artisan db:seed --class=ApLiteratureSeeder          (demo accounts)
 *   php artisan course:seed-ap-literature --teacher=EMAIL   (your own account)
 */
class ApLiteratureSeeder extends CurriculumSeeder
{
    /** course.yaml's `slug`: the course row's slug and every item's slug prefix. */
    public const COURSE_SLUG = 'aplit';

    public static function defaultDir(): string
    {
        return database_path('seeders/data/ap-literature');
    }
}
