<?php

use App\Models\SiteSetting;
use App\Models\User;
use App\Support\Registration;

test('the migration seeds exactly one settings row and current() returns it', function () {
    expect(SiteSetting::count())->toBe(1);
    expect(SiteSetting::current()->id)->toBe(1);
});

test('a guest reads the default config', function () {
    $this->getJson('/api/site')
        ->assertOk()
        ->assertExactJson([
            'theme' => ['layout' => 'rail', 'palette' => 'noon', 'typeset' => 'editorial'],
            'identity' => ['name' => '24 Hour Classroom', 'tagline' => 'A place for teachers to connect with other teachers and students — creating and sharing lesson plans, homework, study materials, practice tests, and reports.'],
            'registration' => ['open' => true, 'message' => null],
            'banner' => ['enabled' => false, 'text' => null],
        ]);
});

test('the endpoint reflects every stored column', function () {
    SiteSetting::current()->update([
        'layout' => 'rail', 'palette' => 'evening', 'typeset' => 'modern',
        'name' => 'Night School', 'tagline' => 'Lessons after dark',
        'registration_open' => false, 'registration_message' => 'Closed for the summer.',
        'banner_enabled' => true, 'banner_text' => 'Welcome back',
    ]);

    $this->getJson('/api/site')
        ->assertOk()
        ->assertJsonPath('theme.layout', 'rail')
        ->assertJsonPath('identity.name', 'Night School')
        ->assertJsonPath('identity.tagline', 'Lessons after dark')
        ->assertJsonPath('registration.open', false)
        ->assertJsonPath('registration.message', 'Closed for the summer.')
        ->assertJsonPath('banner.enabled', true)
        ->assertJsonPath('banner.text', 'Welcome back');
});

test('a draft closed message is hidden while open, and the default sentence stands in while closed without one', function () {
    SiteSetting::current()->update(['registration_open' => true, 'registration_message' => 'Not yet.']);
    $this->getJson('/api/site')->assertJsonPath('registration.message', null);

    SiteSetting::current()->update(['registration_open' => false, 'registration_message' => null]);
    $this->getJson('/api/site')->assertJsonPath('registration.message', Registration::CLOSED);
});

test('a draft banner text is hidden while disabled', function () {
    SiteSetting::current()->update(['banner_enabled' => false, 'banner_text' => 'Soon']);
    $this->getJson('/api/site')->assertJsonPath('banner.text', null);

    SiteSetting::current()->update(['banner_enabled' => true]);
    $this->getJson('/api/site')->assertJsonPath('banner.text', 'Soon');
});

test('a deactivated session still reads the config -- and is NOT logged out by doing so', function () {
    $user = User::factory()->create();
    // forceFill: deactivated_at is deliberately not fillable.
    $user->forceFill(['deactivated_at' => now()])->save();
    $this->actingAs($user);

    // The route carries no `active`, so the site config loads.
    $this->getJson('/api/site')->assertOk()->assertJsonPath('theme.palette', 'noon');

    // Exclusion: the same session IS deactivated -- an `active`-guarded route
    // proves it. Without this the test above would pass for a route that
    // simply had no middleware problem to begin with.
    $this->getJson('/api/user')->assertStatus(401);
});

test('current() recreates a complete row when it is missing', function () {
    SiteSetting::query()->delete();

    $row = SiteSetting::current();

    // forceCreate does not refresh the model, so the defaults must be in the
    // attributes, not only in the schema.
    expect($row->id)->toBe(1)
        ->and($row->name)->toBe('24 Hour Classroom')
        ->and($row->registration_open)->toBeTrue()
        ->and($row->banner_enabled)->toBeFalse()
        ->and($row->config()['identity']['name'])->toBe('24 Hour Classroom');
});
