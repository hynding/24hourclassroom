<?php

use App\Models\Connection;
use App\Models\Follow;
use App\Models\Profile;
use App\Models\User;
use App\Notifications\ProfileModerated;

function admin(): User
{
    return User::factory()->create(['role' => 'admin']);
}

test('a non-admin cannot reach the admin surface', function () {
    $this->actingAs(User::factory()->create(['role' => 'teacher']));

    $this->get('/admin/users')->assertStatus(403);
});

test('a guest is redirected, not 403d', function () {
    $this->get('/admin/users')->assertRedirect('/login');
});

test('an admin sees the user list', function () {
    $this->actingAs(admin());
    User::factory()->create(['name' => 'Findable Fred']);

    $this->get('/admin/users')->assertOk();
});

test('search narrows the list by name or email and excludes non-matches', function () {
    $this->actingAs(admin());
    $match = User::factory()->create(['name' => 'Grace Hopper', 'email' => 'grace@example.com']);
    $noMatch = User::factory()->create(['name' => 'Someone Else', 'email' => 'else@example.com']);

    $ids = collect($this->get('/admin/users?q=hopper')->viewData('page')['props']['users']['data'])
        ->pluck('id')->all();

    expect($ids)->toContain($match->id)->not->toContain($noMatch->id);
});

test('an admin changes a users role', function () {
    $this->actingAs(admin());
    $user = User::factory()->create(['role' => 'student']);

    $this->patch("/admin/users/{$user->id}/role", ['role' => 'teacher'])->assertRedirect();

    expect($user->fresh()->role->value)->toBe('teacher');
});

test('an admin cannot promote anyone to admin through the role endpoint', function () {
    // Admin is granted by hand, deliberately. Allowing it here would make one
    // compromised admin session enough to mint more.
    $this->actingAs(admin());
    $user = User::factory()->create(['role' => 'teacher']);

    $this->patch("/admin/users/{$user->id}/role", ['role' => 'admin'])
        ->assertSessionHasErrors('role');

    expect($user->fresh()->role->value)->toBe('teacher');
});

test('an admin cannot demote themselves', function () {
    $me = admin();
    $this->actingAs($me);

    $this->patch("/admin/users/{$me->id}/role", ['role' => 'teacher'])->assertStatus(403);

    expect($me->fresh()->role->value)->toBe('admin');
});

test('an admin deactivates and reactivates a user', function () {
    $this->actingAs(admin());
    $user = User::factory()->create();

    $this->patch("/admin/users/{$user->id}/deactivate")->assertRedirect();
    expect($user->fresh()->isActive())->toBeFalse();

    $this->patch("/admin/users/{$user->id}/reactivate")->assertRedirect();
    expect($user->fresh()->isActive())->toBeTrue();
});

test('an admin cannot deactivate themselves', function () {
    $me = admin();
    $this->actingAs($me);

    $this->patch("/admin/users/{$me->id}/deactivate")->assertStatus(403);

    expect($me->fresh()->isActive())->toBeTrue();
});

test('moderating a profile clears its content and notifies the user', function () {
    $this->actingAs(admin());
    $user = User::factory()->create();
    Profile::factory()->for($user)->create([
        'bio' => 'bad', 'specialties' => 'also bad',
        'avatar_path' => 'avatars/x.jpg',
        'school' => 'Kept High', 'subjects' => ['math'],
    ]);

    $this->delete("/admin/users/{$user->id}/profile-content")->assertRedirect();

    $profile = $user->fresh()->profile;
    expect($profile->bio)->toBeNull()
        ->and($profile->specialties)->toBeNull()
        ->and($profile->avatar_path)->toBeNull()
        // School and subjects are not moderation targets -- clearing them
        // would be collateral damage, not moderation.
        ->and($profile->school)->toBe('Kept High')
        ->and($profile->subjects)->toBe(['math']);

    expect($user->notifications()->count())->toBe(1)
        ->and($user->notifications()->first()->type)->toBe(ProfileModerated::class);
});

test('a role change leaves existing follows and connections intact', function () {
    $this->actingAs(admin());
    $teacher = User::factory()->create(['role' => 'teacher']);
    $follower = User::factory()->create(['role' => 'student']);
    $peer = User::factory()->create(['role' => 'teacher']);
    Follow::create(['follower_id' => $follower->id, 'followed_id' => $teacher->id]);
    Connection::create([
        'requester_id' => $teacher->id, 'addressee_id' => $peer->id,
        'status' => 'accepted', 'pair_key' => Connection::pairKey($teacher->id, $peer->id),
    ]);

    $this->patch("/admin/users/{$teacher->id}/role", ['role' => 'student']);

    // Deliberate: cascade-deleting someone's relationships as a side effect of
    // an admin typo is worse than a graph that briefly disagrees with the
    // creation rules. The demoted user drops out of the directory instead.
    expect(Follow::count())->toBe(1)->and(Connection::count())->toBe(1);
});
