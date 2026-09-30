<?php

use App\Enums\GenerationStatus;
use App\Enums\Role;
use App\Enums\Visibility;
use App\Models\Assignment;
use App\Models\Attempt;
use App\Models\Connection;
use App\Models\Follow;
use App\Models\Generation;
use App\Models\Integration;
use App\Models\MaterialShare;
use App\Models\Profile;
use App\Models\Test;
use App\Models\User;
use App\Notifications\GenerationModerated;
use App\Notifications\IntegrationModerated;
use App\Notifications\ProfileModerated;
use App\Support\AdminMessages;
use App\Support\AdminMetrics;
use App\Support\GenerationMessages;
use Illuminate\Auth\Events\Verified;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
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

test('resend sends the verification mail once and refuses a verified user', function () {
    Notification::fake();
    $unverified = User::factory()->unverified()->create(['role' => 'teacher']);
    $verified = aTeacher();
    $this->actingAs(adminUser());

    $this->from("/admin/users/{$unverified->id}")->post("/admin/users/{$unverified->id}/verification")
        ->assertRedirect("/admin/users/{$unverified->id}")->assertSessionMissing('notice');
    Notification::assertSentToTimes($unverified, VerifyEmail::class, 1);

    $this->from("/admin/users/{$verified->id}")->post("/admin/users/{$verified->id}/verification")
        ->assertRedirect()->assertSessionHas('notice', AdminMessages::ALREADY_VERIFIED);
    Notification::assertNotSentTo($verified, VerifyEmail::class);
});

test('the admin resend has its own six-per-minute bucket', function () {
    Notification::fake();
    $target = User::factory()->unverified()->create(['role' => 'teacher']);
    $this->actingAs(adminUser());

    foreach (range(1, 6) as $i) {
        $this->post("/admin/users/{$target->id}/verification")->assertRedirect();
    }
    $this->post("/admin/users/{$target->id}/verification")->assertStatus(429);
});

test('force-verify sets the timestamp, fires Verified, leaves deactivation alone, logs, and drops the cache', function () {
    Event::fake([Verified::class]);
    Log::spy();
    $target = User::factory()->unverified()->create(['role' => 'teacher', 'deactivated_at' => now()]);
    $admin = adminUser();
    $this->actingAs($admin);
    $this->get('/dashboard'); // prime the metrics cache
    expect(Cache::has(AdminMetrics::CACHE_KEY))->toBeTrue();

    $this->from("/admin/users/{$target->id}")->patch("/admin/users/{$target->id}/verify")
        ->assertRedirect("/admin/users/{$target->id}")->assertSessionMissing('notice');

    expect($target->fresh()->email_verified_at)->not->toBeNull()
        ->and($target->fresh()->deactivated_at)->not->toBeNull()
        ->and(Cache::has(AdminMetrics::CACHE_KEY))->toBeFalse();
    Event::assertDispatched(Verified::class, fn (Verified $e) => $e->user->id === $target->id);
    Log::shouldHaveReceived('info')->withArgs(fn ($message, $context) => $context['admin_id'] === $admin->id && $context['user_id'] === $target->id)->once();

    $this->patch("/admin/users/{$target->id}/verify")->assertSessionHas('notice', AdminMessages::ALREADY_VERIFIED);
});

test('clear-key tears down, notifies once, composes the notice, and refuses a keyless account before any teardown', function () {
    $teacher = aTeacher();
    $key = withAnthropicKey($teacher)->apiKey();
    $live = Generation::factory()->for($teacher)->create(['session_id' => 'sesn_1']);
    $this->actingAs(adminUser());

    $this->from("/admin/users/{$teacher->id}")->delete("/admin/users/{$teacher->id}/anthropic-key")
        ->assertRedirect("/admin/users/{$teacher->id}")
        ->assertSessionHas('notice', 'Key removed. 1 live generation was cancelled.');

    expect($live->fresh()->status)->toBe(GenerationStatus::Cancelled)
        ->and($live->fresh()->error)->toBe(GenerationMessages::KEY_REMOVED)
        ->and($this->fake->calls['interrupt'][0])->toBe([$key, 'sesn_1'])
        ->and($teacher->notifications()->where('type', IntegrationModerated::class)->count())->toBe(1)
        ->and($teacher->notifications()->where('type', GenerationModerated::class)->count())->toBe(0)
        ->and(detailFor($teacher)['integration']['has_key'])->toBeFalse();

    // Keyless now: a second click must not tear anything down.
    $stillLive = Generation::factory()->for($teacher)->create(['session_id' => 'sesn_2']);
    $this->fake = fakeAnthropic();
    $this->from("/admin/users/{$teacher->id}")->delete("/admin/users/{$teacher->id}/anthropic-key")
        ->assertRedirect()->assertSessionHas('notice', AdminMessages::NO_KEY);
    expect($this->fake->calls)->toBe([])
        ->and($stillLive->fresh()->status)->toBe(GenerationStatus::Running)
        ->and($teacher->notifications()->where('type', IntegrationModerated::class)->count())->toBe(1);
});

test('clear-key names a run it could not cancel', function () {
    // NOTE: really waits five seconds -- the blocking window is the contract.
    $teacher = aTeacher();
    withAnthropicKey($teacher);
    $busy = Generation::factory()->for($teacher)->create(['session_id' => 'sesn_busy']);
    $lock = Cache::lock($busy->lockKey(), 180);
    expect($lock->get())->toBeTrue();
    $this->actingAs(adminUser());

    $this->from("/admin/users/{$teacher->id}")->delete("/admin/users/{$teacher->id}/anthropic-key")
        ->assertSessionHas('notice', 'Key removed. 1 generation could not be cancelled and is still running.');

    expect($busy->fresh()->status)->toBe(GenerationStatus::Running)
        ->and(\App\Support\AdminUserPayload::hasKey($teacher))->toBeFalse();

    $lock->release();
});

test('the key-removed notice composes every case', function () {
    expect(AdminMessages::keyRemoved(0, 0))->toBeNull()
        ->and(AdminMessages::keyRemoved(3, 0))->toBe('Key removed. 3 live generations were cancelled.')
        ->and(AdminMessages::keyRemoved(0, 2))->toBe('Key removed. 2 generations could not be cancelled and are still running.')
        ->and(AdminMessages::keyRemoved(2, 1))->toBe('Key removed. 2 live generations were cancelled; 1 could not be cancelled and is still running.');
});

test('delete refuses an active account, then requires the exact email', function () {
    $teacher = aTeacher(['email' => 'k@example.com']);
    $this->actingAs(adminUser());

    $this->from("/admin/users/{$teacher->id}")->delete("/admin/users/{$teacher->id}", ['confirmation' => 'k@example.com'])
        ->assertRedirect("/admin/users/{$teacher->id}")->assertSessionHas('notice', AdminMessages::DEACTIVATE_FIRST);
    expect(User::find($teacher->id))->not->toBeNull();

    $teacher->forceFill(['deactivated_at' => now()])->save();

    $this->from("/admin/users/{$teacher->id}")->delete("/admin/users/{$teacher->id}")->assertSessionHasErrors('confirmation');
    $this->from("/admin/users/{$teacher->id}")->delete("/admin/users/{$teacher->id}", ['confirmation' => 'wrong@example.com'])->assertSessionHasErrors('confirmation');
    $this->from("/admin/users/{$teacher->id}")->delete("/admin/users/{$teacher->id}", ['confirmation' => 'K@example.com'])->assertSessionHasErrors('confirmation');
    expect(User::find($teacher->id))->not->toBeNull()
        ->and($this->fake->calls)->toBe([]);
});

test('delete removes the account and everything the spec names, and a second delete is a 404', function () {
    Log::spy();
    $teacher = aTeacher(['email' => 'k@example.com']);
    $teacher->forceFill(['deactivated_at' => now()])->save();
    $key = withAnthropicKey($teacher)->apiKey();
    $student = aStudent();
    $peer = aTeacher();
    Profile::factory()->for($teacher)->create(['avatar_path' => 'avatars/k.jpg']);
    Storage::disk('public')->put('avatars/k.jpg', 'bytes');
    $test = aTestWithQuestions($teacher, 2);
    $copy = aTestWithQuestions($peer, 1, ['copied_from_id' => $test->id]);
    Attempt::create(['test_id' => $test->id, 'student_id' => $student->id, 'started_at' => now()]);
    $material = aMaterial($teacher);
    shareWith($material, $student);
    Follow::create(['follower_id' => $student->id, 'followed_id' => $teacher->id]);
    connectAccepted($teacher, $peer);
    Generation::factory()->for($teacher)->create(['session_id' => 'sesn_1']);
    $teacher->createToken('Claude Code', ['mcp']);
    $teacher->notify(new ProfileModerated);
    $admin = adminUser();
    $this->actingAs($admin);
    $this->get('/dashboard');

    $this->from("/admin/users/{$teacher->id}")->delete("/admin/users/{$teacher->id}", ['confirmation' => '  k@example.com '])
        ->assertRedirect('/admin/users')->assertSessionMissing('notice');

    expect(User::find($teacher->id))->toBeNull()
        ->and(Storage::disk('public')->exists('avatars/k.jpg'))->toBeFalse()
        ->and(Storage::disk(config('materials.disk'))->exists($material->path))->toBeFalse()
        ->and(DB::table('personal_access_tokens')->count())->toBe(0)
        ->and(DB::table('notifications')->where('notifiable_id', $teacher->id)->count())->toBe(0)
        ->and(Attempt::count())->toBe(0) // the student's work on the teacher's test: the documented cost
        ->and(MaterialShare::count())->toBe(0)
        ->and(Follow::count())->toBe(0)
        ->and(Connection::count())->toBe(0)
        ->and(Test::find($copy->id)->copied_from_id)->toBeNull()
        ->and($this->fake->calls['interrupt'][0])->toBe([$key, 'sesn_1'])
        ->and(Cache::has(AdminMetrics::CACHE_KEY))->toBeFalse();
    Log::shouldHaveReceived('info')->withArgs(fn ($message, $context) => ($context['user_id'] ?? null) === $teacher->id && $context['admin_id'] === $admin->id)->once();

    $this->delete("/admin/users/{$teacher->id}", ['confirmation' => 'k@example.com'])->assertStatus(404);
});

test('a delete that loses the lock says so and deletes nothing', function () {
    // NOTE: really waits five seconds.
    Log::spy();
    $teacher = aTeacher(['email' => 'k@example.com']);
    $teacher->forceFill(['deactivated_at' => now()])->save();
    $lock = Cache::lock("user-delete:{$teacher->id}", 120);
    expect($lock->get())->toBeTrue();
    $this->actingAs(adminUser());

    $this->from("/admin/users/{$teacher->id}")->delete("/admin/users/{$teacher->id}", ['confirmation' => 'k@example.com'])
        ->assertRedirect('/admin/users')->assertSessionHas('notice', AdminMessages::ALREADY_DELETING);

    expect(User::find($teacher->id))->not->toBeNull()
        ->and($this->fake->calls)->toBe([]);
    Log::shouldNotHaveReceived('info');

    $lock->release();
});
