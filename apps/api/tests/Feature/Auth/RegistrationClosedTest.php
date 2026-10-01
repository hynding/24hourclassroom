<?php

use App\Models\SiteSetting;
use App\Models\User;
use App\Support\Registration;
use Laravel\Socialite\Facades\Socialite;

/*
 * Split across small tests on purpose: every GUEST request through any
 * throttled route (the four throttle:6,1 auth routes AND GET /api/site at
 * 60/min) increments one per-IP counter, so a single test may not make more
 * than six of them or the seventh comes back 429 instead of 403. The web
 * /register routes carry no throttle and do not count.
 */

function closeRegistration(?string $message = 'Closed for the summer.'): void
{
    SiteSetting::current()->update(['registration_open' => false, 'registration_message' => $message]);
}

/** A Socialite user; named apart from GoogleOAuthTest's helper (Pest helpers are global). */
function closedTestGoogleUser(string $id, string $email): object
{
    $user = Mockery::mock(Laravel\Socialite\Two\User::class);
    $user->shouldReceive('getId')->andReturn($id);
    $user->shouldReceive('getEmail')->andReturn($email);
    $user->shouldReceive('getName')->andReturn('Goo Gler');
    $user->shouldReceive('getNickname')->andReturn(null);
    $user->user = ['email_verified' => true];

    return $user;
}

$body = fn (string $email) => [
    'name' => 'T', 'email' => $email, 'password' => 'password', 'password_confirmation' => 'password', 'role' => 'teacher',
];

beforeEach(function () {
    config(['app.frontend_urls' => 'https://24hourclassroom.com']);
    $this->withHeader('Referer', 'http://localhost:3333');
});

test('the SPA register endpoint refuses with a JSON 403 carrying the message and no errors key', function () use ($body) {
    closeRegistration();

    $response = $this->postJson('/api/auth/register', $body('t@example.com'))->assertStatus(403);

    expect($response->json())->toBe(['message' => 'Closed for the summer.'])
        ->and(User::where('email', 't@example.com')->exists())->toBeFalse();
});

test('the refusal is JSON even when the client does not ask for JSON, and never echoes the text as HTML', function () use ($body) {
    closeRegistration('<script>alert(1)</script>');

    $response = $this->withHeader('Accept', '*/*')->post('/api/auth/register', $body('t@example.com'))->assertStatus(403);

    expect($response->headers->get('content-type'))->toStartWith('application/json')
        ->and($response->json('message'))->toBe('<script>alert(1)</script>')
        ->and(User::count())->toBe(0);
});

test('the refusal precedes validation, so an existing email is not confirmed', function () use ($body) {
    closeRegistration();
    User::factory()->create(['email' => 'taken@example.com']);

    expect($this->postJson('/api/auth/register', $body('taken@example.com'))->assertStatus(403)->json())->not->toHaveKey('errors');
});

test('the web register page shows the closed state and the store redirects back', function () use ($body) {
    closeRegistration();

    $this->get('/register')->assertOk()->assertInertia(fn ($page) => $page
        ->component('auth/register')
        ->where('registration.open', false)
        ->where('registration.message', 'Closed for the summer.'));

    $this->post('/register', $body('t@example.com'))->assertRedirect('/register');
    expect(User::count())->toBe(0);
});

test('the web register page hides a draft message while open', function () {
    SiteSetting::current()->update(['registration_open' => true, 'registration_message' => 'Not yet.']);

    $this->get('/register')->assertInertia(fn ($page) => $page
        ->where('registration.open', true)
        ->where('registration.message', null));
});

test('the closed message reaches the web page only inside the escaped page payload', function () {
    closeRegistration('<script>alert(1)</script>');

    $response = $this->get('/register')->assertOk();

    // Blade escapes data-page; app.blade.php has real <script> tags of its own,
    // so the assertion is on the payload string, not on "<script>" alone.
    $response->assertDontSee('<script>alert(1)</script>', false);
    $response->assertInertia(fn ($page) => $page->where('registration.message', '<script>alert(1)</script>'));
});

test('a brand-new Google sign-in is bounced to the login page with nothing left in the session', function () {
    closeRegistration();
    Socialite::shouldReceive('driver->user')->andReturn(closedTestGoogleUser('g-new', 'new@example.com'));

    $this->get('/auth/google/callback')
        ->assertRedirect('https://24hourclassroom.com/login?error=registration_closed')
        ->assertSessionMissing('oauth.google');

    expect(User::where('email', 'new@example.com')->exists())->toBeFalse();
});

test('an existing Google-linked account still logs in while closed', function () {
    closeRegistration();
    $user = User::factory()->create(['email' => 'g@example.com']);
    $user->forceFill(['google_id' => 'g-123'])->save();
    Socialite::shouldReceive('driver->user')->andReturn(closedTestGoogleUser('g-123', 'g@example.com'));

    $this->get('/auth/google/callback')->assertRedirect('https://24hourclassroom.com');
    $this->assertAuthenticatedAs($user);
});

test('OAuth completion refuses while closed', function () {
    closeRegistration();
    $this->withSession(['oauth.google' => ['id' => 'g-new', 'name' => 'New', 'email' => 'new@example.com']]);

    $this->postJson('/api/auth/oauth/complete', ['role' => 'teacher'])
        ->assertStatus(403)
        ->assertJsonPath('message', 'Closed for the summer.');

    expect(User::count())->toBe(0);
});

test('with no custom message the default sentence is used', function () use ($body) {
    closeRegistration(null);

    $this->postJson('/api/auth/register', $body('t@example.com'))->assertStatus(403)->assertJsonPath('message', Registration::CLOSED);
});

test('while open every path behaves as before', function () use ($body) {
    // Web first, while still a guest: the API call logs the test client into
    // the web guard's session (statefulApi()), and /register sits behind
    // `guest` middleware -- doing it second would bounce to the dashboard
    // without ever reaching the controller.
    $this->post('/register', $body('b@example.com'))->assertRedirect(route('dashboard', absolute: false));
    $this->postJson('/api/auth/register', $body('a@example.com'))->assertNoContent();

    expect(User::whereIn('email', ['a@example.com', 'b@example.com'])->count())->toBe(2);
});

test('with no settings row at all, registration is open and nothing writes a row', function () use ($body) {
    SiteSetting::query()->delete();

    $this->postJson('/api/auth/register', $body('t@example.com'))->assertNoContent();

    expect(SiteSetting::count())->toBe(0);
});
