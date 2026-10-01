<?php

use App\Models\SiteSetting;
use App\Models\User;

test('the Inertia shell name is the site name', function () {
    SiteSetting::current()->update(['name' => 'Night School']);
    $this->actingAs(User::factory()->create());

    $this->get('/dashboard')->assertOk()->assertInertia(fn ($page) => $page->where('name', 'Night School'));
});

test('with no settings row the shell falls back to the app name without writing one', function () {
    SiteSetting::query()->delete();

    $this->get('/')->assertOk()->assertInertia(fn ($page) => $page->where('name', config('app.name')));

    expect(SiteSetting::count())->toBe(0);
});

test('the document title carries the site name', function () {
    SiteSetting::current()->update(['name' => 'Night School']);

    $this->get('/')->assertSee('<title inertia>Night School</title>', false);
});
