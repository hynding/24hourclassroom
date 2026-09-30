<?php

use App\Enums\Role;
use App\Enums\Visibility;
use App\Models\Assignment;
use App\Models\Attempt;
use App\Models\Connection;
use App\Models\Follow;
use App\Models\Generation;
use App\Models\Integration;
use App\Models\Profile;
use App\Models\User;
use App\Notifications\ProfileModerated;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

function adminUser(): User
{
    return User::factory()->create(['role' => 'admin']);
}

/** The page's `detail` prop for a user, as the given admin. */
function detailFor(User $target, ?User $as = null): array
{
    test()->actingAs($as ?? adminUser());

    return test()->get("/admin/users/{$target->id}")->assertOk()->viewData('page')['props']['detail'];
}

beforeEach(function () {
    Storage::fake(config('materials.disk'));
    Storage::fake('public');
    $this->fake = fakeAnthropic();
});

test('non-admin roles cannot open a user detail page and a guest is sent to login', function () {
    $target = aTeacher();

    foreach (Role::cases() as $role) {
        if ($role === Role::Admin) {
            continue;
        }
        $this->actingAs(User::factory()->create(['role' => $role->value]));
        $this->get("/admin/users/{$target->id}")->assertStatus(403);
    }

    $this->app['auth']->forgetGuards();
    $this->get("/admin/users/{$target->id}")->assertRedirect('/login');
});

test('a user with nothing renders every empty state and creates no integration row', function () {
    $target = aStudent(['name' => 'Sam Student', 'email' => 'sam@example.com']);

    $detail = detailFor($target);

    expect($detail['user'])->toMatchArray([
        'id' => $target->id, 'name' => 'Sam Student', 'email' => 'sam@example.com', 'role' => 'student',
        'deactivated_at' => null, 'google_linked' => false, 'is_self' => false, 'actionable' => true,
        'role_options' => ['teacher'],
    ])
        ->and($detail['user']['email_verified_at'])->not->toBeNull()
        ->and($detail['profile'])->toBeNull()
        ->and($detail['integration'])->toBeNull()
        ->and($detail['counts'])->toBe([
            'tests' => ['private' => 0, 'public' => 0], 'materials' => ['private' => 0, 'public' => 0],
            'generations_live' => 0, 'generations_total' => 0, 'attempts_taken' => 0, 'attempts_received' => 0,
            'assignments' => 0, 'shares_out' => 0, 'tokens' => 0,
        ])
        ->and($detail['following'])->toBe([])
        ->and($detail['followers'])->toBe([])
        ->and($detail['connections'])->toBe([])
        ->and($detail['tests'])->toBe([])
        ->and($detail['materials'])->toBe([])
        ->and($detail['generations'])->toBe([])
        ->and($detail['notifications'])->toBe([])
        // The HasOne, never Integration::forUser(): a GET must not insert.
        ->and(Integration::count())->toBe(0);
});

test('actionable, is_self and role_options for every kind of target', function () {
    $me = adminUser();
    $otherAdmin = User::factory()->create(['role' => 'admin']);
    $teacher = aTeacher();

    expect(detailFor($teacher, $me)['user'])->toMatchArray(['actionable' => true, 'is_self' => false, 'role_options' => ['student']])
        ->and(detailFor($otherAdmin, $me)['user'])->toMatchArray(['actionable' => false, 'is_self' => false, 'role_options' => []])
        ->and(detailFor($me, $me)['user'])->toMatchArray(['actionable' => false, 'is_self' => true, 'role_options' => []]);
});

test('profile, integration states, google link and the key never leaks', function () {
    $target = aTeacher();
    $target->forceFill(['google_id' => 'g-123'])->save();
    Profile::factory()->for($target)->create(['bio' => 'Hi', 'school' => 'Kept High', 'specialties' => 'labs', 'subjects' => ['math'], 'grade_levels' => ['3-5'], 'avatar_path' => 'avatars/a.jpg']);

    // No row at all.
    expect(detailFor($target)['integration'])->toBeNull();

    // A row whose key was removed but whose provisioning survived (the APP_KEY-rotation edge).
    $integration = Integration::factory()->create(['user_id' => $target->id, 'anthropic_api_key' => null, 'anthropic_key_hint' => null, 'anthropic_key_verified_at' => null, 'anthropic_environment_id' => 'env_1', 'anthropic_agent_id' => 'agent_1']);
    $detail = detailFor($target);
    expect($detail['integration'])->toBe(['has_key' => false, 'key_hint' => null, 'key_verified_at' => null, 'provisioned' => true])
        ->and($detail['user']['google_linked'])->toBeTrue()
        ->and($detail['profile'])->toMatchArray(['bio' => 'Hi', 'school' => 'Kept High', 'specialties' => 'labs', 'subjects' => ['math'], 'grade_levels' => ['3-5']])
        ->and($detail['profile']['avatar_url'])->toBe(Storage::disk('public')->url('avatars/a.jpg'));

    // A real key.
    $integration->forceFill(['anthropic_api_key' => 'sk-ant-test-secret-value', 'anthropic_key_hint' => 'alue', 'anthropic_key_verified_at' => now()])->save();
    $this->actingAs(adminUser());
    $props = $this->get("/admin/users/{$target->id}")->viewData('page')['props'];
    expect($props['detail']['integration'])->toMatchArray(['has_key' => true, 'key_hint' => 'alue', 'provisioned' => true]);

    // The page's OWN props: the shared ziggy prop carries every route URI
    // (reset-password, forgot-password), so a whole-props search for
    // "password" is guaranteed to match.
    $own = json_encode(Arr::except($props, ['ziggy', 'auth', 'quote', 'errors', 'sidebarOpen', 'name']));
    foreach (['anthropic_api_key', 'sk-ant-test-secret-value', 'google_id', 'password', 'remember_token'] as $needle) {
        expect($own)->not->toContain($needle);
    }
});

test('counts cover every visibility, attempts both ways, assignments, shares and tokens', function () {
    $teacher = aTeacher();
    $student = aStudent();
    $publicTest = aTestWithQuestions($teacher, 2, ['visibility' => 'public', 'published_at' => now()]);
    aTestWithQuestions($teacher, 1);
    $material = aMaterial($teacher, ['visibility' => 'public', 'published_at' => now()]);
    shareWith($material, $student);
    Assignment::create(['test_id' => $publicTest->id, 'student_id' => $student->id, 'teacher_id' => $teacher->id]);
    Attempt::create(['test_id' => $publicTest->id, 'student_id' => $student->id, 'started_at' => now()]);
    // The teacher's own attempt on their own test is NOT "received".
    Attempt::create(['test_id' => $publicTest->id, 'student_id' => $teacher->id, 'started_at' => now()]);
    Generation::factory()->for($teacher)->create();
    Generation::factory()->for($teacher)->done()->create();
    $teacher->createToken('Claude Code', ['mcp']);

    $counts = detailFor($teacher)['counts'];

    expect(array_keys($counts['tests']))->toBe(array_column(Visibility::cases(), 'value'))
        ->and($counts['tests'])->toBe(['private' => 1, 'public' => 1])
        ->and($counts['materials'])->toBe(['private' => 0, 'public' => 1])
        ->and($counts)->toMatchArray([
            'generations_live' => 1, 'generations_total' => 2,
            'attempts_taken' => 1, 'attempts_received' => 1, 'assignments' => 1, 'shares_out' => 1, 'tokens' => 1,
        ]);

    $studentCounts = detailFor($student)['counts'];
    expect($studentCounts)->toMatchArray(['attempts_taken' => 1, 'attempts_received' => 0, 'assignments' => 1, 'shares_out' => 0]);
});

test('relationships list both directions, both statuses, pending students by name, capped at fifty', function () {
    $teacher = aTeacher(['name' => 'Ms K']);
    $student = aStudent(['name' => 'Sam']);
    $peer = aTeacher(['name' => 'Mr P']);
    Follow::create(['follower_id' => $student->id, 'followed_id' => $teacher->id]);
    Follow::create(['follower_id' => $teacher->id, 'followed_id' => $peer->id]);
    connectAccepted($teacher, $peer);
    Connection::create(['requester_id' => $teacher->id, 'addressee_id' => $student->id, 'status' => 'pending', 'pair_key' => Connection::pairKey($teacher->id, $student->id)]);
    foreach (range(1, 51) as $i) {
        Follow::create(['follower_id' => aStudent()->id, 'followed_id' => $teacher->id]);
    }

    $detail = detailFor($teacher);

    expect($detail['following'])->toHaveCount(1)
        ->and($detail['following'][0]['user'])->toBe(['id' => $peer->id, 'name' => 'Mr P', 'role' => 'teacher'])
        ->and($detail['following'][0]['follow_id'])->toBeInt()
        ->and($detail['followers'])->toHaveCount(50)
        ->and(collect($detail['followers'])->pluck('user.id'))->not->toContain($student->id) // the oldest fell off the cap
        ->and($detail['connections'])->toHaveCount(2)
        ->and(collect($detail['connections'])->pluck('status')->sort()->values()->all())->toBe(['accepted', 'pending'])
        ->and(collect($detail['connections'])->firstWhere('status', 'pending')['counterpart'])->toBe(['id' => $student->id, 'name' => 'Sam', 'role' => 'student']);
});

test('content and notifications are the newest ten, with live question counts and messages', function () {
    $teacher = aTeacher();
    foreach (range(1, 11) as $i) {
        aTestWithQuestions($teacher, 2, ['title' => "Test {$i}", 'created_at' => now()->subMinutes(20 - $i)]);
        aMaterial($teacher, ['title' => "Material {$i}", 'created_at' => now()->subMinutes(20 - $i)]);
        Generation::factory()->for($teacher)->create(['title' => "Run {$i}", 'created_at' => now()->subMinutes(20 - $i)]);
    }
    $newestTest = $teacher->tests()->orderByDesc('created_at')->first();
    $newestTest->questions()->first()->delete(); // soft-deleted: not live
    $teacher->notify(new ProfileModerated);

    $detail = detailFor($teacher);

    expect($detail['tests'])->toHaveCount(10)
        ->and($detail['tests'][0])->toMatchArray(['id' => $newestTest->id, 'title' => 'Test 11', 'visibility' => 'private', 'published_at' => null, 'question_count' => 1])
        ->and($detail['materials'])->toHaveCount(10)
        ->and($detail['materials'][0]['title'])->toBe('Material 11')
        ->and($detail['materials'][0]['size_bytes'])->toBeInt()
        ->and($detail['generations'])->toHaveCount(10)
        ->and($detail['generations'][0])->toMatchArray(['title' => 'Run 11', 'live' => true])
        ->and($detail['notifications'])->toHaveCount(1)
        ->and($detail['notifications'][0]['type'])->toBe('ProfileModerated')
        ->and($detail['notifications'][0]['message'])->toBeString()
        ->and($detail['notifications'][0]['read_at'])->toBeNull();
});

test('a missing user id is a 404 for an admin', function () {
    $this->actingAs(adminUser());

    $this->get('/admin/users/999999')->assertStatus(404);
});
