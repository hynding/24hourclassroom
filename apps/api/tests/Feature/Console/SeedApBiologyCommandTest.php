<?php

use App\Enums\Role;
use App\Models\Assignment;
use App\Models\Connection;
use App\Models\Material;
use App\Models\Test;
use App\Models\User;
use Database\Seeders\ApBiologySeeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

beforeEach(function () {
    Storage::fake(config('materials.disk'));
    // The command resolves the seeder from the container; point it at the
    // three-item fixture course and pass its options through.
    app()->bind(ApBiologySeeder::class, fn ($app, array $p) => new ApBiologySeeder(
        base_path('tests/Fixtures/course'),
        $p['teacherEmail'] ?? null,
        $p['studentEmail'] ?? null,
        $p['withStudent'] ?? true,
    ));
});

test('--teacher attaches the course to an existing teacher and creates no demo teacher', function () {
    $me = aTeacher(['email' => 'me@example.com', 'password' => Hash::make('my-own-secret')]);

    $this->artisan('course:seed-ap-biology', ['--teacher' => 'me@example.com', '--force' => true])->assertSuccessful();

    expect(Test::whereNotNull('slug')->pluck('user_id')->unique()->all())->toBe([$me->id])
        ->and(Material::whereNotNull('slug')->pluck('user_id')->unique()->all())->toBe([$me->id])
        ->and(User::where('email', 'apbio@example.com')->exists())->toBeFalse()
        ->and(Hash::check('my-own-secret', $me->fresh()->password))->toBeTrue()
        ->and($me->fresh()->role)->toBe(Role::Teacher);

    // The demo student is still created by default, connected and assigned.
    $student = User::where('email', 'apbio-student@example.com')->sole();
    expect(Connection::acceptedBetween($me, $student))->toBeTrue()
        ->and(Assignment::where('student_id', $student->id)->where('teacher_id', $me->id)->count())->toBe(2);
});

test('--teacher must name an existing, verified, active account whose role is teacher', function () {
    foreach (Role::cases() as $role) {
        if ($role === Role::Teacher) {
            continue;
        }
        User::factory()->create(['email' => "{$role->value}@example.com", 'role' => $role->value]);
        $this->artisan('course:seed-ap-biology', ['--teacher' => "{$role->value}@example.com", '--force' => true])
            ->expectsOutputToContain('not a teacher')
            ->assertFailed();
    }

    aTeacher(['email' => 'unverified@example.com', 'email_verified_at' => null]);
    $this->artisan('course:seed-ap-biology', ['--teacher' => 'unverified@example.com', '--force' => true])
        ->expectsOutputToContain('not verified')->assertFailed();

    aTeacher(['email' => 'gone@example.com', 'deactivated_at' => now()]);
    $this->artisan('course:seed-ap-biology', ['--teacher' => 'gone@example.com', '--force' => true])
        ->expectsOutputToContain('deactivated')->assertFailed();

    $this->artisan('course:seed-ap-biology', ['--teacher' => 'nobody@example.com', '--force' => true])
        ->expectsOutputToContain('No account')->assertFailed();

    // Every refusal happens before a single course row is written.
    expect(Test::count())->toBe(0)->and(Material::count())->toBe(0)
        ->and(User::where('email', 'like', 'apbio%')->count())->toBe(0);
});

test('--no-student creates no student, no connection and no assignments', function () {
    aTeacher(['email' => 'me@example.com']);

    $this->artisan('course:seed-ap-biology', ['--teacher' => 'me@example.com', '--no-student' => true, '--force' => true])->assertSuccessful();

    expect(Test::count())->toBe(2)
        ->and(User::where('email', 'apbio-student@example.com')->exists())->toBeFalse()
        ->and(Assignment::count())->toBe(0)
        ->and(Connection::count())->toBe(0);
});

test('--student assigns the course to an existing student, and must be one', function () {
    aTeacher(['email' => 'me@example.com']);
    $kid = aStudent(['email' => 'kid@example.com']);

    $this->artisan('course:seed-ap-biology', ['--teacher' => 'me@example.com', '--student' => 'teacher@example.com', '--force' => true])
        ->expectsOutputToContain('No account')->assertFailed();
    aTeacher(['email' => 'teacher@example.com']);
    $this->artisan('course:seed-ap-biology', ['--teacher' => 'me@example.com', '--student' => 'teacher@example.com', '--force' => true])
        ->expectsOutputToContain('not a student')->assertFailed();

    $this->artisan('course:seed-ap-biology', ['--teacher' => 'me@example.com', '--student' => 'kid@example.com', '--force' => true])->assertSuccessful();

    expect(Assignment::where('student_id', $kid->id)->count())->toBe(2)
        ->and(User::where('email', 'apbio-student@example.com')->exists())->toBeFalse();

    $this->artisan('course:seed-ap-biology', ['--student' => 'kid@example.com', '--no-student' => true, '--force' => true])
        ->expectsOutputToContain('not both')->assertFailed();
});

test('a re-run with a new owner moves every test and material to them, keeping ids', function () {
    $this->artisan('course:seed-ap-biology', ['--force' => true])->assertSuccessful();
    $testIds = Test::orderBy('id')->pluck('id')->all();
    $materialIds = Material::orderBy('id')->pluck('id')->all();
    $me = aTeacher(['email' => 'me@example.com']);

    $this->artisan('course:seed-ap-biology', ['--teacher' => 'me@example.com', '--force' => true])->assertSuccessful();

    expect(Test::orderBy('id')->pluck('id')->all())->toBe($testIds)
        ->and(Material::orderBy('id')->pluck('id')->all())->toBe($materialIds)
        ->and(Test::pluck('user_id')->unique()->all())->toBe([$me->id])
        ->and(Material::pluck('user_id')->unique()->all())->toBe([$me->id]);
});

test('an owner without room for the course is refused before anything is written', function () {
    $me = aTeacher(['email' => 'me@example.com']);
    aMaterial($me);
    aMaterial($me);
    config(['materials.max_files_per_teacher' => 4]); // 2 of mine + 3 course files = 5

    $this->artisan('course:seed-ap-biology', ['--teacher' => 'me@example.com', '--force' => true])
        ->expectsOutputToContain('cap is 4')->assertFailed();

    expect(Test::count())->toBe(0)->and(Material::count())->toBe(2);
});

test('outside local and testing, demo accounts get a random password that is printed once', function () {
    app()->detectEnvironment(fn () => 'production');

    $this->artisan('course:seed-ap-biology', ['--force' => true])
        ->expectsOutputToContain('apbio@example.com')
        ->expectsOutputToContain('apbio-student@example.com')
        ->assertSuccessful();

    foreach (['apbio@example.com', 'apbio-student@example.com'] as $email) {
        expect(Hash::check(ApBiologySeeder::PASSWORD, User::where('email', $email)->sole()->password))->toBeFalse($email);
    }
});

test('locally the demo accounts keep the documented password', function () {
    $this->artisan('course:seed-ap-biology', ['--force' => true])->assertSuccessful();

    expect(Hash::check('password', User::where('email', 'apbio@example.com')->sole()->password))->toBeTrue();
});
