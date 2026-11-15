<?php

namespace Database\Seeders;

use Database\Seeders\Curriculum\CurriculumSeeder;

/**
 * The AP English Language and Composition course:
 * database/seeders/data/ap-english-language, original writing around
 * public-domain arguments and U.S. government works. Organised by CED skill
 * like AP Literature (`skills` in its course.yaml) and linted by the same
 * ApLiterature\Lint, tuned by the `lint` block of its course.yaml.
 *
 *   php artisan db:seed --class=ApEnglishLanguageSeeder          (demo accounts)
 *   php artisan course:seed-ap-english-language --teacher=EMAIL   (your own account)
 */
class ApEnglishLanguageSeeder extends CurriculumSeeder
{
    /** course.yaml's `slug`: the course row's slug and every item's slug prefix. */
    public const COURSE_SLUG = 'aplang';

    public static function defaultDir(): string
    {
        return database_path('seeders/data/ap-english-language');
    }
}
