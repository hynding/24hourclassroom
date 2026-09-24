<?php

use App\Models\Generation;
use App\Models\Integration;
use App\Models\Test;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

beforeEach(function () {
    // No Referer here: /settings/profile is a web (session) route, not the
    // Sanctum stateful API -- ProfileUpdateTest beside this file is the same.
    Storage::fake(config('materials.disk'));
    $this->fake = fakeAnthropic();
});

test('deleting the account tears down the live generations and archives the agent and the environment', function () {
    $teacher = aTeacher();
    $integration = Integration::factory()->create([
        'user_id' => $teacher->id,
        'anthropic_environment_id' => 'env_1',
        'anthropic_agent_id' => 'agent_1',
        'anthropic_agent_version' => 1,
        'anthropic_config_hash' => str_repeat('a', 64),
    ]);
    $key = $integration->apiKey();

    Generation::factory()->create([
        'user_id' => $teacher->id,
        'session_id' => 'sesn_1',
        'file_ids' => ['file_1', 'file_2'],
    ]);

    $this->actingAs($teacher)
        ->delete('/settings/profile', ['password' => 'password'])
        ->assertRedirect('/');

    expect($this->fake->calls['interrupt'][0])->toBe([$key, 'sesn_1'])
        ->and($this->fake->calls['archiveSession'][0])->toBe([$key, 'sesn_1'])
        ->and(array_map(fn (array $call) => $call[1], $this->fake->calls['deleteFile']))->toBe(['file_1', 'file_2'])
        ->and($this->fake->calls['archiveAgent'][0])->toBe([$key, 'agent_1'])
        ->and($this->fake->calls['archiveEnvironment'][0])->toBe([$key, 'env_1']);
});

test('deleting the account leaves no tokens, integration, generation or authored test behind', function () {
    $teacher = aTeacher();
    withAnthropicKey($teacher);
    $teacher->createToken('Claude Code', ['mcp']);
    Generation::factory()->create(['user_id' => $teacher->id]);
    aTestWithQuestions($teacher, 2);

    expect(DB::table('personal_access_tokens')->count())->toBe(1);

    $this->actingAs($teacher)
        ->delete('/settings/profile', ['password' => 'password'])
        ->assertRedirect('/');

    // personal_access_tokens is a morph table with NO foreign key: nothing
    // cascades it, so the controller must delete it by hand.
    expect(DB::table('personal_access_tokens')->count())->toBe(0)
        ->and(Integration::count())->toBe(0)
        ->and(Generation::count())->toBe(0)
        ->and(Test::count())->toBe(0)
        ->and(User::find($teacher->id))->toBeNull();
});
