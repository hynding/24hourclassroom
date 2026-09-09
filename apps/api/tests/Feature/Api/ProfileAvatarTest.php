<?php

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

beforeEach(function () {
    $this->withHeader('Referer', 'http://localhost:3333');
    $this->withHeader('Accept', 'application/json');
    Storage::fake('public', ['url' => config('filesystems.disks.public.url')]);
});

test('a user uploads an avatar and gets an absolute url back', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $response = $this->post('/api/profile/avatar', [
        'avatar' => UploadedFile::fake()->image('me.jpg'),
    ])->assertOk();

    $path = $user->fresh()->profile->avatar_path;

    expect($path)->toStartWith('avatars/');
    Storage::disk('public')->assertExists($path);
    $response->assertJsonPath('avatar_url', Storage::disk('public')->url($path));
});

test('uploading a second avatar deletes the first file', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $this->post('/api/profile/avatar', ['avatar' => UploadedFile::fake()->image('one.jpg')]);
    $first = $user->fresh()->profile->avatar_path;

    $this->post('/api/profile/avatar', ['avatar' => UploadedFile::fake()->image('two.jpg')]);
    $second = $user->fresh()->profile->avatar_path;

    expect($second)->not->toBe($first);
    Storage::disk('public')->assertMissing($first);
    Storage::disk('public')->assertExists($second);
});

test('files over 1024kb are rejected', function () {
    $this->actingAs(User::factory()->create());

    $this->post('/api/profile/avatar', [
        'avatar' => UploadedFile::fake()->image('huge.jpg')->size(1025),
    ])->assertStatus(422)->assertJsonValidationErrors('avatar');
});

test('non-images are rejected', function () {
    $this->actingAs(User::factory()->create());

    $this->post('/api/profile/avatar', [
        'avatar' => UploadedFile::fake()->create('resume.pdf', 10, 'application/pdf'),
    ])->assertStatus(422)->assertJsonValidationErrors('avatar');
});

test('a missing file reports a size-aware message, because PHP drops oversized uploads before validation', function () {
    $this->actingAs(User::factory()->create());

    $this->postJson('/api/profile/avatar', [])
        ->assertStatus(422)
        ->assertJsonPath('errors.avatar.0', 'Choose an image file under 1MB.');
});

test('deleting the avatar clears the path and removes the file', function () {
    $user = User::factory()->create();
    $this->actingAs($user);
    $this->post('/api/profile/avatar', ['avatar' => UploadedFile::fake()->image('me.jpg')]);
    $path = $user->fresh()->profile->avatar_path;

    $this->deleteJson('/api/profile/avatar')->assertNoContent();

    expect($user->fresh()->profile->avatar_path)->toBeNull();
    Storage::disk('public')->assertMissing($path);
});

test('deleting when there is no avatar is a no-op', function () {
    $user = User::factory()->create();
    Profile::factory()->for($user)->create(['avatar_path' => null]);
    $this->actingAs($user);

    $this->deleteJson('/api/profile/avatar')->assertNoContent();
});

test('unverified users cannot upload', function () {
    $this->actingAs(User::factory()->unverified()->create());

    $this->post('/api/profile/avatar', ['avatar' => UploadedFile::fake()->image('me.jpg')])
        ->assertStatus(403);
});
