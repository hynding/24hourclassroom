<?php

use App\Models\User;

beforeEach(function () {
    $this->withHeader('Referer', 'http://localhost:3333');
});

test('a deactivated user gets 401 from /api/user, not 403', function () {
    // 403 here would reject inside the SPA's connectedCallback and take down
    // the entire app shell. This is a regression test for that, not a style
    // preference -- assert the exact status.
    $this->actingAs(User::factory()->create(['deactivated_at' => now()]));

    $this->getJson('/api/user')->assertStatus(401);
});

test('an active user still reaches /api/user', function () {
    $this->actingAs(User::factory()->create(['deactivated_at' => null]));

    $this->getJson('/api/user')->assertOk();
});

test('a deactivated user is blocked from B1 endpoints', function () {
    $this->actingAs(User::factory()->create(['deactivated_at' => now()]));

    $this->getJson('/api/profile')->assertStatus(401);
    $this->putJson('/api/profile', ['school' => 'X'])->assertStatus(401);
});

test('logout is deliberately NOT guarded so a deactivated session can still be cleared', function () {
    // Guarding logout protects nothing -- it only invalidates the session --
    // and authStore.logout() clears its state after the call resolves, so a
    // 401 there would strand the SPA in a signed-in state.
    $this->actingAs(User::factory()->create(['deactivated_at' => now()]));

    $this->postJson('/api/auth/logout')->assertNoContent();
});

test('a deactivated user cannot log in and is told why', function () {
    $user = User::factory()->create([
        'email' => 'gone@example.com',
        'deactivated_at' => now(),
    ]);

    $this->postJson('/api/auth/login', [
        'email' => $user->email, 'password' => 'password',
    ])->assertStatus(422)->assertJsonValidationErrors('email');

    $this->assertGuest();
});

test('an active user can still log in', function () {
    // Proves the login guard rejects only deactivated accounts rather than
    // refusing everyone.
    $user = User::factory()->create(['email' => 'here@example.com', 'deactivated_at' => null]);

    $this->postJson('/api/auth/login', [
        'email' => $user->email, 'password' => 'password',
    ])->assertNoContent();

    $this->assertAuthenticated();
});

test('deactivated_at is never serialized to the client', function () {
    $user = User::factory()->create(['deactivated_at' => null]);
    $this->actingAs($user);

    expect($this->getJson('/api/user')->json())->not->toHaveKey('deactivated_at');
});

test('every authenticated route on the api host carries active, with logout the only exemption', function () {
    // Structural rather than four point tests: this fails for the NEXT route
    // someone adds behind `auth` without `active`, which is exactly how
    // /dashboard, routes/settings.php and routes/auth.php came to be holes.
    $authenticated = collect(app('router')->getRoutes()->getRoutes())
        ->filter(function ($route) {
            $middleware = $route->gatherMiddleware();

            return collect($middleware)->contains(fn ($m) => $m === 'auth' || str_starts_with((string) $m, 'auth:'));
        });

    // Exempt by design (spec, decision 4): logout only invalidates the
    // session, so guarding it protects nothing and would strand the SPA in a
    // signed-in state.
    $exempt = ['api/auth/logout', 'logout'];

    $uris = $authenticated->map(fn ($route) => $route->uri())->unique()->values();

    // Guards against a vacuous pass: if the filter above ever stops matching,
    // the assertion below would hold over an empty collection.
    expect($uris)->toContain('api/user', 'api/connections', 'dashboard', 'settings/password', 'verify-email')
        ->and($uris->count())->toBeGreaterThan(15);

    $unguarded = $authenticated
        ->reject(fn ($route) => in_array($route->uri(), $exempt, true))
        ->reject(fn ($route) => in_array('active', $route->gatherMiddleware(), true))
        ->map(fn ($route) => implode('|', $route->methods()).' /'.$route->uri())
        ->unique()->values()->all();

    expect($unguarded)->toBe([]);

    // And the exemption is a real exemption, not a stale name in a list.
    expect($authenticated->map(fn ($route) => $route->uri())->intersect($exempt)->values()->all())
        ->toEqualCanonicalizing($exempt);
});

test('a deactivated user cannot use the api hosts web session to change their own password or name', function () {
    $user = User::factory()->create([
        'name' => 'Original Name',
        'password' => bcrypt('password'),
        'deactivated_at' => now(),
    ]);
    $originalHash = $user->password;
    $this->actingAs($user);

    $this->put('/settings/password', [
        'current_password' => 'password',
        'password' => 'newpassword123',
        'password_confirmation' => 'newpassword123',
    ])->assertRedirect('/login');

    $this->actingAs($user);
    $this->patch('/settings/profile', ['name' => 'Hacked', 'email' => $user->email])
        ->assertRedirect('/login');

    // Assert the database, not the status: a redirect that still wrote would
    // look identical from the outside.
    $fresh = $user->fresh();
    expect($fresh->name)->toBe('Original Name')
        ->and($fresh->password)->toBe($originalHash);
});

test('an active user can still change their password and name through settings', function () {
    // The counter-test: proves `active` on the settings group rejects only
    // deactivated accounts rather than breaking the page for everyone.
    $user = User::factory()->create(['name' => 'Original Name', 'deactivated_at' => null]);
    $originalHash = $user->password;
    $this->actingAs($user);

    $this->put('/settings/password', [
        'current_password' => 'password',
        'password' => 'newpassword123',
        'password_confirmation' => 'newpassword123',
    ])->assertSessionHasNoErrors();

    $this->patch('/settings/profile', ['name' => 'Renamed', 'email' => $user->email])
        ->assertSessionHasNoErrors();

    $fresh = $user->fresh();
    expect($fresh->name)->toBe('Renamed')
        ->and($fresh->password)->not->toBe($originalHash);
});

test('a deactivated admin cannot read the dashboard', function () {
    $this->actingAs(User::factory()->create(['role' => 'admin', 'deactivated_at' => now()]));

    $this->get('/dashboard')->assertRedirect('/login');
});

test('a deactivated user cannot sign in through the api hosts web login form', function () {
    $user = User::factory()->create(['email' => 'gone@example.com', 'deactivated_at' => now()]);

    $this->post('/login', ['email' => $user->email, 'password' => 'password'])
        ->assertSessionHasErrors('email');

    $this->assertGuest();
});

test('an active user can still sign in through the web login form', function () {
    $user = User::factory()->create(['email' => 'here@example.com', 'deactivated_at' => null]);

    $this->post('/login', ['email' => $user->email, 'password' => 'password'])
        ->assertRedirect(route('dashboard', absolute: false));

    $this->assertAuthenticatedAs($user);
});

test('a deactivated session loses its viewer privileges on the public profile endpoint', function () {
    // /api/users/{user} is reachable by guests, so it was left off the
    // `active` sweep -- and a deactivated teacher kept reading the names of
    // every student they had been connected to.
    $teacher = User::factory()->create(['role' => 'teacher', 'deactivated_at' => now()]);
    $other = User::factory()->create(['role' => 'teacher']);
    $this->actingAs($teacher);

    $this->getJson("/api/users/{$other->id}")->assertStatus(401);

    // A guest still gets the public payload -- the route is public by design.
    auth()->logout();
    $this->getJson("/api/users/{$other->id}")->assertOk()->assertJsonPath('role', 'teacher');
});
