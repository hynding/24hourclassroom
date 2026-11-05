<?php

use App\Models\Course;
use App\Models\Test;
use Database\Seeders\TrigonometrySeeder;
use Illuminate\Support\Facades\Storage;

beforeEach(function () {
    Storage::fake(config('materials.disk'));
});

// The options and the owner checks are SeedCurriculum's, proven once in
// SeedApBiologyCommandTest; this only proves the command is wired to the
// Trigonometry seeder and passes the options through.
test('course:seed-trigonometry runs the Trigonometry seeder with the options given', function () {
    $me = aTeacher(['email' => 'me@example.com']);
    $seen = null;
    app()->bind(TrigonometrySeeder::class, function ($app, array $p) use (&$seen) {
        $seen = $p;

        return new TrigonometrySeeder(base_path('tests/Fixtures/course'), $p['teacherEmail'] ?? null, $p['studentEmail'] ?? null, $p['withStudent'] ?? true);
    });

    $this->artisan('course:seed-trigonometry', ['--teacher' => 'me@example.com', '--no-student' => true, '--force' => true])->assertSuccessful();

    expect($seen)->toBe(['teacherEmail' => 'me@example.com', 'studentEmail' => null, 'withStudent' => false])
        ->and(Course::sole()->user_id)->toBe($me->id)
        ->and(Test::whereNotNull('slug')->pluck('user_id')->unique()->all())->toBe([$me->id]);
});
