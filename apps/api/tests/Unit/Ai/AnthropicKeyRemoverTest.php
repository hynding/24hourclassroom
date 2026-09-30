<?php

use App\Ai\AnthropicKeyRemover;
use App\Enums\GenerationStatus;
use App\Models\Generation;
use App\Models\Integration;
use App\Support\GenerationMessages;
use Illuminate\Support\Facades\Cache;

beforeEach(function () {
    $this->fake = fakeAnthropic();
});

test('it cancels live runs, archives the organisation, clears the key and reports the counts', function () {
    $teacher = aTeacher();
    $integration = withAnthropicKey($teacher);
    $integration->forceFill(['anthropic_environment_id' => 'env_1', 'anthropic_agent_id' => 'agent_1'])->save();
    $key = $integration->apiKey();
    $live = Generation::factory()->for($teacher)->create(['session_id' => 'sesn_1']);
    Generation::factory()->for($teacher)->done()->create();

    $result = app(AnthropicKeyRemover::class)->forUser($teacher);

    $fresh = Integration::forUser($teacher);
    expect($result)->toBe(['cancelled' => 1, 'skipped' => 0])
        ->and($live->fresh()->status)->toBe(GenerationStatus::Cancelled)
        ->and($live->fresh()->error)->toBe(GenerationMessages::KEY_REMOVED)
        ->and($this->fake->calls['archiveAgent'][0])->toBe([$key, 'agent_1'])
        ->and($this->fake->calls['archiveEnvironment'][0])->toBe([$key, 'env_1'])
        ->and($fresh->getRawOriginal('anthropic_api_key'))->toBeNull()
        ->and($fresh->anthropic_key_hint)->toBeNull()
        ->and($fresh->anthropic_key_verified_at)->toBeNull()
        ->and($fresh->anthropic_environment_id)->toBeNull()
        ->and($fresh->anthropic_agent_id)->toBeNull();
});

test('a run whose lock is held elsewhere is skipped, counted, and left running', function () {
    // NOTE: really waits five seconds -- the blocking window is the contract.
    $teacher = aTeacher();
    withAnthropicKey($teacher);
    $busy = Generation::factory()->for($teacher)->create(['session_id' => 'sesn_busy']);
    $lock = Cache::lock($busy->lockKey(), 180);
    expect($lock->get())->toBeTrue();

    $result = app(AnthropicKeyRemover::class)->forUser($teacher);

    expect($result)->toBe(['cancelled' => 0, 'skipped' => 1])
        ->and($busy->fresh()->status)->toBe(GenerationStatus::Running)
        ->and(Integration::forUser($teacher)->getRawOriginal('anthropic_api_key'))->toBeNull();

    $lock->release();
});
