<?php

use App\Models\User;
use App\Notifications\NewFollower;
use Illuminate\Support\Facades\DB;

test('profile page is displayed', function () {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->get('/settings/profile');

    $response->assertOk();
});

test('profile information can be updated', function () {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->patch('/settings/profile', [
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

    $response
        ->assertSessionHasNoErrors()
        ->assertRedirect('/settings/profile');

    $user->refresh();

    expect($user->name)->toBe('Test User');
    expect($user->email)->toBe('test@example.com');
    expect($user->email_verified_at)->toBeNull();
});

test('email verification status is unchanged when the email address is unchanged', function () {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->patch('/settings/profile', [
            'name' => 'Test User',
            'email' => $user->email,
        ]);

    $response
        ->assertSessionHasNoErrors()
        ->assertRedirect('/settings/profile');

    expect($user->refresh()->email_verified_at)->not->toBeNull();
});

test('user can delete their account', function () {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->delete('/settings/profile', [
            'password' => 'password',
        ]);

    $response
        ->assertSessionHasNoErrors()
        ->assertRedirect('/');

    $this->assertGuest();
    expect($user->fresh())->toBeNull();
});

test('correct password must be provided to delete account', function () {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->from('/settings/profile')
        ->delete('/settings/profile', [
            'password' => 'wrong-password',
        ]);

    $response
        ->assertSessionHasErrors('password')
        ->assertRedirect('/settings/profile');

    expect($user->fresh())->not->toBeNull();
});

test('deleting an account clears the notifications in the same transaction', function () {
    // The notifications table carries a polymorphic notifiable_id with no
    // foreign key, so the purge and the delete are two independent writes.
    // The spec's data-model section requires them to be one unit; the code
    // ran them bare, so a failure between them lost the notifications and
    // left the account standing.
    //
    // Proven by forcing exactly that failure: without DB::transaction the
    // notifications are already gone by the time the user delete throws.
    $user = User::factory()->create();
    $user->notify(new NewFollower(User::factory()->create()));
    expect(DB::table('notifications')->where('notifiable_id', $user->id)->count())->toBe(1);

    User::deleting(function () {
        throw new RuntimeException('simulated failure between the two writes');
    });

    $this->actingAs($user)->withoutExceptionHandling();

    expect(fn () => $this->delete('/settings/profile', ['password' => 'password']))
        ->toThrow(RuntimeException::class);

    expect(DB::table('notifications')->where('notifiable_id', $user->id)->count())->toBe(1)
        ->and(User::find($user->id))->not->toBeNull();
});

test('a successful account deletion still removes both the notifications and the user', function () {
    // The counter-test: the rollback above must not come from the deletes
    // never happening.
    $user = User::factory()->create();
    $user->notify(new NewFollower(User::factory()->create()));

    $this->actingAs($user)
        ->delete('/settings/profile', ['password' => 'password'])
        ->assertRedirect('/');

    expect(DB::table('notifications')->where('notifiable_id', $user->id)->count())->toBe(0)
        ->and(User::find($user->id))->toBeNull();
});
