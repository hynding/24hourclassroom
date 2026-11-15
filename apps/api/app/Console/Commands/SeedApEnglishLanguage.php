<?php

namespace App\Console\Commands;

use Database\Seeders\ApEnglishLanguageSeeder;

/** Seed (or re-seed in place) the AP English Language course. See SeedCurriculum. */
class SeedApEnglishLanguage extends SeedCurriculum
{
    protected $signature = 'course:seed-ap-english-language'.self::OPTIONS;

    protected $description = 'Seed the AP English Language course, owned by an existing teacher or by the demo account';

    protected function seeder(): string
    {
        return ApEnglishLanguageSeeder::class;
    }
}
