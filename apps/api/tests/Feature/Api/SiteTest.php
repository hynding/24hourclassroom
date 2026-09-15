<?php

use App\Models\SiteSetting;
use App\Models\User;

test('the migration seeds exactly one settings row and current() returns it', function () {
    expect(SiteSetting::count())->toBe(1);
    expect(SiteSetting::current()->id)->toBe(1);
});

test('a guest reads the default theme', function () {
    $this->getJson('/api/site')
        ->assertOk()
        ->assertExactJson(['theme' => ['layout' => 'stacked', 'palette' => 'noon', 'typeset' => 'editorial']]);
});

test('the endpoint reflects the stored row, not a constant', function () {
    SiteSetting::current()->update(['layout' => 'rail', 'palette' => 'evening', 'typeset' => 'modern']);

    $this->getJson('/api/site')
        ->assertOk()
        ->assertJsonPath('theme.layout', 'rail')
        ->assertJsonPath('theme.palette', 'evening')
        ->assertJsonPath('theme.typeset', 'modern');
});

test('a deactivated session still reads the theme -- and is NOT logged out by doing so', function () {
    $user = User::factory()->create();
    // forceFill: deactivated_at is deliberately not fillable.
    $user->forceFill(['deactivated_at' => now()])->save();
    $this->actingAs($user);

    // The theme route carries no `active`, so the site config loads.
    $this->getJson('/api/site')->assertOk()->assertJsonPath('theme.palette', 'noon');

    // Exclusion: the same session IS deactivated -- an `active`-guarded route
    // proves it. Without this the test above would pass for a route that
    // simply had no middleware problem to begin with.
    $this->getJson('/api/user')->assertStatus(401);
});

test('current() recreates row 1 if it has been deleted', function () {
    SiteSetting::query()->delete();

    $row = SiteSetting::current();

    expect($row->id)->toBe(1);
    expect($row->palette->value)->toBe('noon');
});
