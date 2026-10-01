<?php

use App\Enums\Role;
use App\Models\SiteSetting;
use App\Models\User;

function siteAdmin(): User
{
    return User::factory()->create(['role' => 'admin']);
}

test('only an admin can open or save site settings', function () {
    foreach (Role::cases() as $role) {
        if ($role === Role::Admin) {
            continue;
        }
        $this->actingAs(User::factory()->create(['role' => $role->value]));
        $this->get('/admin/site')->assertStatus(403);
        $this->patch('/admin/site', ['name' => 'X', 'registration_open' => true, 'banner_enabled' => false])->assertStatus(403);
    }
    $this->app['auth']->forgetGuards();
    $this->get('/admin/site')->assertRedirect('/login');

    expect(SiteSetting::current()->name)->toBe('24 Hour Classroom');
});

test('the edit page carries the raw columns, drafts included', function () {
    // A config()-based edit would null both drafts; the admin is editing them.
    SiteSetting::current()->update([
        'name' => 'Night School', 'tagline' => 'After dark',
        'registration_open' => true, 'registration_message' => 'Not yet.',
        'banner_enabled' => false, 'banner_text' => 'Soon',
    ]);
    $this->actingAs(siteAdmin());

    $this->get('/admin/site')->assertOk()->assertInertia(fn ($page) => $page
        ->component('admin/site')
        ->where('site.name', 'Night School')
        ->where('site.tagline', 'After dark')
        ->where('site.registration_open', true)
        ->where('site.registration_message', 'Not yet.')
        ->where('site.banner_enabled', false)
        ->where('site.banner_text', 'Soon'));
});

test('a round trip changes the public config', function () {
    $this->actingAs(siteAdmin());

    $this->patch('/admin/site', [
        'name' => 'Night School', 'tagline' => 'After dark',
        'registration_open' => false, 'registration_message' => 'Closed.',
        'banner_enabled' => true, 'banner_text' => 'Hello',
    ])->assertRedirect();

    $this->getJson('/api/site')
        ->assertJsonPath('identity.name', 'Night School')
        ->assertJsonPath('registration.message', 'Closed.')
        ->assertJsonPath('banner.text', 'Hello');
});

test('every rule', function (array $body, string $field) {
    $this->actingAs(siteAdmin());
    $valid = ['name' => 'Ok', 'tagline' => null, 'registration_open' => true, 'registration_message' => null, 'banner_enabled' => false, 'banner_text' => null];

    $this->patch('/admin/site', array_merge($valid, $body))->assertSessionHasErrors($field);
})->with([
    'name required' => [['name' => ''], 'name'],
    'name 60' => [['name' => str_repeat('a', 61)], 'name'],
    'tagline 160' => [['tagline' => str_repeat('a', 161)], 'tagline'],
    'registration_open boolean' => [['registration_open' => 'maybe'], 'registration_open'],
    'message 300' => [['registration_message' => str_repeat('a', 301)], 'registration_message'],
    'banner_enabled boolean' => [['banner_enabled' => 'maybe'], 'banner_enabled'],
    'banner text required when enabled' => [['banner_enabled' => true, 'banner_text' => null], 'banner_text'],
    'banner text required when enabled as a form value' => [['banner_enabled' => '1', 'banner_text' => ''], 'banner_text'],
    'banner text 300' => [['banner_enabled' => true, 'banner_text' => str_repeat('a', 301)], 'banner_text'],
]);

test('blank strings store null', function () {
    $this->actingAs(siteAdmin());

    $this->patch('/admin/site', ['name' => 'Ok', 'tagline' => '   ', 'registration_open' => true, 'registration_message' => '', 'banner_enabled' => false, 'banner_text' => ' '])
        ->assertRedirect()->assertSessionHasNoErrors();

    $row = SiteSetting::current();
    expect($row->tagline)->toBeNull()->and($row->registration_message)->toBeNull()->and($row->banner_text)->toBeNull();
});
