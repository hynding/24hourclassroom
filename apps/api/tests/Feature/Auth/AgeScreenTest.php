<?php

use App\Enums\Role;
use App\Models\User;
use App\Support\AgeScreen;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Session;

beforeEach(function () {
    $this->withHeader('Referer', 'http://localhost:3333');
});

function studentSignup(array $extra = []): array
{
    return array_merge([
        'name' => 'Sam', 'email' => 'sam@example.com',
        'password' => 'password', 'password_confirmation' => 'password',
        'role' => 'student',
    ], $extra);
}

test('a student must give a birth month and year, and an under-13 one is refused with nothing stored', function () {
    $this->postJson('/api/auth/register', studentSignup())->assertStatus(422)->assertJsonValidationErrors('birth_year');

    $year = (int) now()->year - 10;
    $this->postJson('/api/auth/register', studentSignup(['birth_month' => 3, 'birth_year' => $year]))
        ->assertStatus(422)->assertJsonPath('errors.birth_year.0', AgeScreen::UNDER_AGE);
    expect(User::where('email', 'sam@example.com')->exists())->toBeFalse();
});

test('a 13-year-old student signs up, and the answer is not kept anywhere on the user', function () {
    $this->postJson('/api/auth/register', studentSignup(['birth_month' => 1, 'birth_year' => (int) now()->year - 14]))->assertNoContent();

    $user = User::where('email', 'sam@example.com')->sole();
    expect(json_encode($user->getAttributes()))->not->toContain('birth');
});

test('roles that do not screen age need no answer', function () {
    $this->postJson('/api/auth/register', studentSignup(['role' => 'teacher', 'email' => 't@example.com']))->assertNoContent();
});

test('the web register page refuses an under-13 student too', function () {
    $this->post('/register', studentSignup(['birth_month' => 6, 'birth_year' => (int) now()->year - 8]))
        ->assertSessionHasErrors('birth_year');
    expect(User::count())->toBe(0);
});

test('Google sign-up refuses an under-13 student and forgets the Google details', function () {
    Session::put('oauth.google', ['id' => 'g-9', 'name' => 'Kid', 'email' => 'kid@example.com']);

    $this->postJson('/api/auth/oauth/complete', ['role' => 'student', 'birth_month' => 2, 'birth_year' => (int) now()->year - 9])
        ->assertStatus(422)->assertJsonValidationErrors('birth_year');

    expect(Session::has('oauth.google'))->toBeFalse()->and(User::count())->toBe(0);
});

test('a birth month counts as its last day, so the 13th birthday month must be over', function () {
    $today = CarbonImmutable::create(2026, 11, 20);
    expect(AgeScreen::oldEnough(2013, 10, $today))->toBeTrue()
        ->and(AgeScreen::oldEnough(2013, 11, $today))->toBeFalse()
        ->and(AgeScreen::oldEnough(2013, 11, CarbonImmutable::create(2026, 11, 30)))->toBeTrue()
        ->and(AgeScreen::oldEnough(2014, 1, $today))->toBeFalse();
});

test('every role either screens age or is one a child would not pick alone', function () {
    $screened = array_values(array_filter(Role::cases(), fn (Role $r) => $r->screensAge()));
    expect(array_map(fn (Role $r) => $r->value, $screened))->toBe(['student', 'assistant']);
});
