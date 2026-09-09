<?php

use App\Models\Profile;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

test('a user has one lazily-created profile', function () {
    $user = User::factory()->create();

    expect($user->profile)->toBeNull();

    $profile = $user->profile()->create(['school' => 'Rivet High']);

    expect($user->fresh()->profile->school)->toBe('Rivet High')
        ->and($profile->user->id)->toBe($user->id);
});

test('subjects and grade levels round-trip as arrays', function () {
    $profile = Profile::factory()->for(User::factory())->create([
        'subjects' => ['math', 'computer-science'],
        'grade_levels' => ['9-12'],
    ]);

    expect($profile->fresh()->subjects)->toBe(['math', 'computer-science'])
        ->and($profile->fresh()->grade_levels)->toBe(['9-12']);
});

test('avatar_url is an absolute url and avatar_path is never serialized', function () {
    Storage::fake('public', ['url' => config('filesystems.disks.public.url')]);

    $profile = Profile::factory()->for(User::factory())->create([
        'avatar_path' => 'avatars/x.jpg',
    ]);

    $array = $profile->toArray();

    expect($array['avatar_url'])->toBe(Storage::disk('public')->url('avatars/x.jpg'))
        ->and($array['avatar_url'])->toStartWith('http')
        ->and($array['avatar_url'])->toContain('avatars/x.jpg')
        ->and($array)->not->toHaveKey('avatar_path');
});

test('avatar_url is null when there is no avatar', function () {
    $profile = Profile::factory()->for(User::factory())->create(['avatar_path' => null]);

    expect($profile->toArray()['avatar_url'])->toBeNull();
});
