<?php

use App\Enums\GenerationStatus;
use App\Models\Generation;
use App\Models\Integration;
use App\Support\GenerationMessages;
use App\Support\GenerationPayload;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

test('the generation config carries exactly the values the spec fixes', function () {
    expect(config('generation.model'))->toBe('claude-opus-5')
        ->and(config('generation.effort'))->toBe('high')
        ->and(config('generation.budget_cents'))->toBe(200)
        ->and(config('generation.max_materials'))->toBe(5)
        ->and(config('generation.min_questions'))->toBe(5)
        ->and(config('generation.max_questions'))->toBe(30)
        ->and(config('generation.max_tool_failures'))->toBe(3)
        ->and(config('generation.max_run_minutes'))->toBe(30)
        ->and(config('generation.environment_name'))->toBe('24hc-generate')
        ->and(config('generation.agent_name'))->toBe('24hc test generator')
        ->and(config('generation.mount_dir'))->toBe('/workspace/materials');
});

test('the stored api key column is ciphertext and apiKey() returns the plaintext', function () {
    $teacher = aTeacher();
    $integration = Integration::create(['user_id' => $teacher->id, 'anthropic_api_key' => 'sk-ant-plaintext-value']);

    $stored = DB::table('integrations')->where('id', $integration->id)->value('anthropic_api_key');

    expect($stored)->not->toBe('sk-ant-plaintext-value')
        ->and(Crypt::decryptString($stored))->toBe('sk-ant-plaintext-value')
        ->and($integration->fresh()->apiKey())->toBe('sk-ant-plaintext-value')
        ->and($integration->fresh()->hasKey())->toBeTrue();

    // $hidden: the key must never ride out in a serialised model either.
    expect($integration->fresh()->toArray())->not->toHaveKey('anthropic_api_key');
});

test('a key that no longer decrypts reads as no key, is logged, and is cleared', function () {
    // An APP_KEY rotation, reproduced the cheap way: garbage straight into the
    // column. The `encrypted` cast throws DecryptException on read, and that
    // must never reach the user as a 500.
    $teacher = aTeacher();
    $integration = Integration::factory()->create(['user_id' => $teacher->id]);
    DB::table('integrations')->where('id', $integration->id)->update(['anthropic_api_key' => 'not-a-ciphertext']);

    Log::spy();

    $reloaded = Integration::find($integration->id);

    expect($reloaded->apiKey())->toBeNull()
        ->and($reloaded->hasKey())->toBeFalse();

    Log::shouldHaveReceived('warning');

    $row = DB::table('integrations')->where('id', $integration->id)->first();
    expect($row->anthropic_api_key)->toBeNull()
        ->and($row->anthropic_key_hint)->toBeNull()
        ->and($row->anthropic_key_verified_at)->toBeNull();
});

test('forUser returns the same row twice and clearProvisioning nulls the four columns', function () {
    $teacher = aTeacher();

    $first = Integration::forUser($teacher);
    $second = Integration::forUser($teacher);

    expect($second->id)->toBe($first->id)
        ->and(Integration::where('user_id', $teacher->id)->count())->toBe(1);

    $first->forceFill([
        'anthropic_environment_id' => 'env_1',
        'anthropic_agent_id' => 'agent_1',
        'anthropic_agent_version' => 3,
        'anthropic_config_hash' => str_repeat('a', 64),
    ])->save();

    $first->clearProvisioning();

    $row = Integration::find($first->id);
    expect($row->anthropic_environment_id)->toBeNull()
        ->and($row->anthropic_agent_id)->toBeNull()
        ->and($row->anthropic_agent_version)->toBeNull()
        ->and($row->anthropic_config_hash)->toBeNull();
});

test('every GenerationStatus case reports its own terminality', function () {
    expect(GenerationStatus::Queued->isTerminal())->toBeFalse()
        ->and(GenerationStatus::Running->isTerminal())->toBeFalse()
        ->and(GenerationStatus::AwaitingTool->isTerminal())->toBeFalse()
        ->and(GenerationStatus::Done->isTerminal())->toBeTrue()
        ->and(GenerationStatus::Failed->isTerminal())->toBeTrue()
        ->and(GenerationStatus::Cancelled->isTerminal())->toBeTrue()
        ->and(GenerationStatus::BudgetReached->isTerminal())->toBeTrue();

    // terminal() is what whereNotIn() reads; an added case must not silently
    // become "live" or "terminal" without this test moving.
    expect(GenerationStatus::terminal())->toBe(['done', 'failed', 'cancelled', 'budget_reached'])
        ->and(count(GenerationStatus::cases()))->toBe(7);
});

test('the two computed generation messages read from config', function () {
    expect(GenerationMessages::budget())->toBe('Stopped at the $2.00 budget before a draft was saved.')
        ->and(GenerationMessages::rejected())->toBe('The draft was rejected 3 times.');

    config(['generation.budget_cents' => 550, 'generation.max_tool_failures' => 4]);

    expect(GenerationMessages::budget())->toBe('Stopped at the $5.50 budget before a draft was saved.')
        ->and(GenerationMessages::rejected())->toBe('The draft was rejected 4 times.');
});

test('markTerminal truncates a huge error, clears the pending columns and stamps finished_at', function () {
    $generation = Generation::factory()->create([
        'pending_tool_event_id' => 'sevt_1',
        'pending_tool_result' => ['content' => [['type' => 'text', 'text' => 'owed']], 'is_error' => false],
    ]);

    $generation->markTerminal(GenerationStatus::Failed, str_repeat('x', 70000));

    $fresh = $generation->fresh();
    expect(strlen($fresh->error))->toBe(60000)
        ->and($fresh->status)->toBe(GenerationStatus::Failed)
        ->and($fresh->isTerminal())->toBeTrue()
        ->and($fresh->finished_at)->not->toBeNull()
        ->and($fresh->pending_tool_event_id)->toBeNull()
        ->and($fresh->pending_tool_result)->toBeNull();
});

test('archived_at and teardown_attempts default to null and zero', function () {
    // fresh(), not the in-memory model: create() never set either attribute,
    // so only a re-read proves what the COLUMN default actually is.
    $generation = Generation::factory()->create()->fresh();

    expect($generation->archived_at)->toBeNull()
        ->and($generation->teardown_attempts)->toBe(0);
});

test('the live scope hides exactly the terminal rows', function () {
    $teacher = aTeacher();
    Generation::factory()->create(['user_id' => $teacher->id]);                 // running
    Generation::factory()->queued()->create(['user_id' => $teacher->id]);
    Generation::factory()->done()->create(['user_id' => $teacher->id]);
    Generation::factory()->failed()->create(['user_id' => $teacher->id]);

    expect($teacher->generations()->live()->count())->toBe(2)
        ->and($teacher->generations()->count())->toBe(4)
        ->and($teacher->integration)->toBeNull();
});

test('lockKey names the cache lock every advance, cancel and teardown share', function () {
    $generation = Generation::factory()->create();

    expect($generation->lockKey())->toBe("generation:{$generation->id}");
});

test('GenerationPayload::for has exactly the fifteen keys the SPA contract names', function () {
    $generation = Generation::factory()->create(['instructions' => 'Two decimals.', 'material_ids' => [4, 7]]);

    expect(array_keys(GenerationPayload::for($generation)))->toBe([
        'id', 'title', 'subject', 'grade_level', 'instructions', 'question_count',
        'material_ids', 'status', 'agent_note', 'error', 'list_cost_cents',
        'test_id', 'started_at', 'finished_at', 'created_at',
    ]);

    expect(GenerationPayload::for($generation)['material_ids'])->toBe([4, 7])
        ->and(GenerationPayload::for($generation)['instructions'])->toBe('Two decimals.');
});
