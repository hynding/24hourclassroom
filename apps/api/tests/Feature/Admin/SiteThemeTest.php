<?php

use App\Enums\Layout;
use App\Enums\Palette;
use App\Enums\Typeset;
use App\Models\SiteSetting;
use App\Models\User;

function themeAdmin(): User
{
    return User::factory()->create(['role' => 'admin']);
}

test('a non-admin gets 403 on both the page and the update', function () {
    $this->actingAs(User::factory()->create(['role' => 'teacher']));

    $this->get('/admin/site-theme')->assertStatus(403);
    $this->patch('/admin/site-theme', ['layout' => 'rail', 'palette' => 'evening', 'typeset' => 'modern'])
        ->assertStatus(403);

    // Exclusion: the refused update changed nothing.
    expect(SiteSetting::current()->palette)->toBe(Palette::Noon);
});

test('a guest is redirected to login', function () {
    $this->get('/admin/site-theme')->assertRedirect('/login');
});

test('an admin sees the current theme and every option', function () {
    SiteSetting::current()->update(['palette' => 'slate']);
    $this->actingAs(themeAdmin());

    $this->get('/admin/site-theme')
        ->assertOk()
        ->assertInertia(fn ($page) => $page
            ->component('admin/site-theme')
            ->where('theme.palette', 'slate')
            ->where('theme.layout', 'stacked')
            ->has('options.layouts', count(Layout::cases()))
            ->has('options.palettes', count(Palette::cases()))
            ->has('options.typesets', count(Typeset::cases())));
});

test('every valid combination sticks', function () {
    $this->actingAs(themeAdmin());

    foreach (Layout::cases() as $layout) {
        foreach (Palette::cases() as $palette) {
            foreach (Typeset::cases() as $typeset) {
                $this->patch('/admin/site-theme', [
                    'layout' => $layout->value, 'palette' => $palette->value, 'typeset' => $typeset->value,
                ])->assertRedirect();

                expect(SiteSetting::current()->theme())->toBe([
                    'layout' => $layout->value, 'palette' => $palette->value, 'typeset' => $typeset->value,
                ]);
            }
        }
    }
});

test('an unknown value is a 422 and the row is untouched', function () {
    $this->actingAs(themeAdmin());

    $this->patch('/admin/site-theme', ['layout' => 'stacked', 'palette' => 'neon', 'typeset' => 'editorial'])
        ->assertSessionHasErrors('palette');

    expect(SiteSetting::current()->palette)->toBe(Palette::Noon);
});

test('a missing field is a 422', function () {
    $this->actingAs(themeAdmin());

    $this->patch('/admin/site-theme', ['layout' => 'rail'])
        ->assertSessionHasErrors(['palette', 'typeset']);
});
