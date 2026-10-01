<?php

use App\Models\Generation;
use App\Models\Integration;
use App\Models\Profile;
use App\Models\User;
use App\Services\AccountDeleter;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

beforeEach(function () {
    Storage::fake(config('materials.disk'));
    Storage::fake('public');
    $this->fake = fakeAnthropic();
});

test('it tears down Anthropic, deletes materials and their files, the avatar, tokens, notifications and the row', function () {
    $teacher = aTeacher();
    $key = withAnthropicKey($teacher)->apiKey();
    Generation::factory()->for($teacher)->create(['session_id' => 'sesn_1', 'file_ids' => ['file_1']]);
    $material = aMaterial($teacher);
    Profile::factory()->for($teacher)->create(['avatar_path' => 'avatars/a.jpg']);
    Storage::disk('public')->put('avatars/a.jpg', 'bytes');
    $teacher->createToken('Claude Code', ['mcp']);
    $teacher->notify(new \App\Notifications\ProfileModerated);

    expect(AccountDeleter::delete($teacher))->toBeTrue();

    expect($this->fake->calls['interrupt'][0])->toBe([$key, 'sesn_1'])
        ->and($this->fake->calls['deleteFile'][0])->toBe([$key, 'file_1'])
        ->and(Storage::disk(config('materials.disk'))->exists($material->path))->toBeFalse()
        ->and(Storage::disk('public')->exists('avatars/a.jpg'))->toBeFalse()
        ->and(DB::table('personal_access_tokens')->count())->toBe(0)
        ->and(DB::table('notifications')->count())->toBe(0)
        ->and(Integration::count())->toBe(0)
        ->and(Generation::count())->toBe(0)
        ->and(User::find($teacher->id))->toBeNull();
});

test('a user with no profile and no integration deletes cleanly', function () {
    $student = aStudent();

    expect(AccountDeleter::delete($student))->toBeTrue()
        ->and(User::find($student->id))->toBeNull()
        ->and($this->fake->calls)->toBe([]);
});

test('it returns false and does nothing when the row is already gone', function () {
    $student = aStudent();
    $stale = User::find($student->id);
    $student->delete();

    expect(AccountDeleter::delete($stale))->toBeFalse()
        ->and($this->fake->calls)->toBe([]);
});

test('it returns false after five seconds when the lock is held elsewhere, and deletes nothing', function () {
    // NOTE: really waits five seconds -- the blocking window is the contract.
    $teacher = aTeacher();
    withAnthropicKey($teacher);
    $lock = Cache::lock("user-delete:{$teacher->id}", 120);
    expect($lock->get())->toBeTrue();

    expect(AccountDeleter::delete($teacher))->toBeFalse()
        ->and(User::find($teacher->id))->not->toBeNull()
        ->and($this->fake->calls)->toBe([]);

    $lock->release();
});
