<?php

use App\Models\Course;
use App\Models\Test;
use Database\Seeders\ApPhysics1Seeder;
use Illuminate\Support\Facades\Storage;

beforeEach(function () {
    Storage::fake(config('materials.disk'));
});

// The options and the owner checks are SeedCurriculum's, proven once in
// SeedApBiologyCommandTest; this only proves the command is wired to the
// AP Physics 1 seeder and passes the options through.
test('course:seed-ap-physics-1 runs the AP Physics 1 seeder with the options given', function () {
    $me = aTeacher(['email' => 'me@example.com']);
    $seen = null;
    app()->bind(ApPhysics1Seeder::class, function ($app, array $p) use (&$seen) {
        $seen = $p;

        return new ApPhysics1Seeder(base_path('tests/Fixtures/course'), $p['teacherEmail'] ?? null, $p['studentEmail'] ?? null, $p['withStudent'] ?? true);
    });

    $this->artisan('course:seed-ap-physics-1', ['--teacher' => 'me@example.com', '--no-student' => true, '--force' => true])->assertSuccessful();

    expect($seen)->toBe(['teacherEmail' => 'me@example.com', 'studentEmail' => null, 'withStudent' => false])
        ->and(Course::sole()->user_id)->toBe($me->id)
        ->and(Test::whereNotNull('slug')->pluck('user_id')->unique()->all())->toBe([$me->id]);
});
