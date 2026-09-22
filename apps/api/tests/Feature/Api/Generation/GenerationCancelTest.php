<?php

use App\Enums\GenerationStatus;
use App\Enums\Role;
use App\Http\Controllers\Api\GenerationCancelController;
use App\Models\Generation;
use App\Models\Integration;
use App\Models\User;
use App\Support\GenerationMessages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

beforeEach(function () {
    $this->withHeader('Referer', 'http://localhost:3333');
    $this->fake = fakeAnthropic();
});

test('cancelling a running generation tears the session down, records the cost and returns the payload', function () {
    $teacher = aTeacher();
    $key = withAnthropicKey($teacher)->apiKey();
    $this->fake->returnsSessionCost(150);

    $generation = Generation::factory()->create([
        'user_id' => $teacher->id,
        'session_id' => 'sesn_1',
        'file_ids' => ['file_1'],
    ]);

    $this->actingAs($teacher)
        ->postJson("/api/generations/{$generation->id}/cancel")
        ->assertOk()
        ->assertJsonPath('id', $generation->id)
        ->assertJsonPath('status', GenerationStatus::Cancelled->value)
        ->assertJsonPath('list_cost_cents', 150)
        // A user cancel carries no error sentence; only a system cancel does.
        ->assertJsonPath('error', null);

    expect($this->fake->calls['interrupt'][0])->toBe([$key, 'sesn_1'])
        ->and($this->fake->calls['retrieveSession'])->toHaveCount(1)
        ->and($this->fake->calls['archiveSession'][0])->toBe([$key, 'sesn_1'])
        ->and($this->fake->calls['deleteFile'][0])->toBe([$key, 'file_1']);

    $fresh = $generation->fresh();
    expect($fresh->status)->toBe(GenerationStatus::Cancelled)
        ->and($fresh->finished_at)->not->toBeNull()
        ->and($fresh->list_cost_cents)->toBe(150)
        ->and($fresh->file_ids)->toBeNull();
});

test('cancelling a terminal generation is a 200 that changes nothing and calls nothing', function () {
    $teacher = aTeacher();
    withAnthropicKey($teacher);
    $generation = Generation::factory()->done()->create(['user_id' => $teacher->id, 'session_id' => 'sesn_1']);
    // Read it back rather than trusting the in-memory Carbon: the column is
    // second-precision and now() is not.
    $finishedAt = $generation->fresh()->finished_at;

    $this->actingAs($teacher)
        ->postJson("/api/generations/{$generation->id}/cancel")
        ->assertOk()
        ->assertJsonPath('status', GenerationStatus::Done->value);

    expect($this->fake->calls)->toBe([])
        ->and($generation->fresh()->finished_at->equalTo($finishedAt))->toBeTrue();
});

test('with the key removed the cancel is local only', function () {
    $teacher = aTeacher();
    Integration::create(['user_id' => $teacher->id]);
    $generation = Generation::factory()->create(['user_id' => $teacher->id, 'session_id' => 'sesn_1', 'file_ids' => ['file_1']]);

    $this->actingAs($teacher)
        ->postJson("/api/generations/{$generation->id}/cancel")
        ->assertOk()
        ->assertJsonPath('status', GenerationStatus::Cancelled->value);

    expect($this->fake->calls)->toBe([])
        ->and($generation->fresh()->file_ids)->toBeNull();
});

test('another teachers generation and a missing id are one byte-identical 404', function () {
    config(['app.debug' => false]);

    $teacher = aTeacher();
    withAnthropicKey($teacher);
    $foreign = Generation::factory()->create(['user_id' => aTeacher()->id]);

    $this->actingAs($teacher);

    $missing = $this->postJson('/api/generations/99999/cancel')->assertStatus(404);
    $foreignResponse = $this->postJson("/api/generations/{$foreign->id}/cancel")->assertStatus(404);

    expect($foreignResponse->getContent())->toBe($missing->getContent())
        ->and($foreign->fresh()->status)->toBe(GenerationStatus::Running)
        ->and($this->fake->calls)->toBe([]);
});

test('a cancel that cannot take the lock inside five seconds is a 409', function () {
    // NOTE: this test really does take about five seconds -- that blocking
    // window is the contract, and a shorter one would not prove it.
    $teacher = aTeacher();
    withAnthropicKey($teacher);
    $generation = Generation::factory()->create(['user_id' => $teacher->id]);

    $lock = Cache::lock($generation->lockKey(), 180);
    expect($lock->get())->toBeTrue();

    $this->actingAs($teacher)
        ->postJson("/api/generations/{$generation->id}/cancel")
        ->assertStatus(409)
        ->assertJsonPath('message', GenerationMessages::BUSY);

    expect($generation->fresh()->status)->toBe(GenerationStatus::Running)
        ->and($this->fake->calls)->toBe([]);

    $lock->release();
});

test('a generation made terminal by a concurrent holder while this request waited for the lock is left alone', function () {
    // Simulates the race the lock exists to prevent: something else (today
    // IntegrationTeardown, tomorrow the advancer) holds the lock and
    // finishes the row for a reason of its own (here, a removed key) before
    // this cancel gets its turn. The stale pre-block read must not win.
    //
    // This deliberately bypasses HTTP/route-model-binding: binding re-fetches
    // the row at request-dispatch time, which in a synchronous test always
    // happens AFTER the DB write below, so a request built via postJson()
    // would already see the terminal row and could never distinguish this
    // controller with the refresh() fix from one without it. Invoking the
    // controller directly lets $stale be the PRE-block read the fix exists
    // to protect against.
    $teacher = aTeacher();
    withAnthropicKey($teacher);
    $generation = Generation::factory()->create(['user_id' => $teacher->id, 'session_id' => 'sesn_1']);

    // What the controller would have bound before the concurrent write.
    $stale = Generation::find($generation->id);

    Generation::whereKey($generation->id)->update([
        'status' => GenerationStatus::Cancelled,
        'error' => GenerationMessages::KEY_REMOVED,
        'finished_at' => now(),
    ]);

    $request = Request::create("/api/generations/{$generation->id}/cancel", 'POST');
    $request->setUserResolver(fn () => $teacher);

    $response = app(GenerationCancelController::class)($request, $stale);

    expect($response->getStatusCode())->toBe(200)
        ->and($response->getData(true)['error'])->toBe(GenerationMessages::KEY_REMOVED)
        ->and($this->fake->calls)->toBe([]);
});

test('only a teacher may cancel', function () {
    $owner = aTeacher();
    $generation = Generation::factory()->create(['user_id' => $owner->id]);

    foreach (Role::cases() as $role) {
        if ($role === Role::Teacher) {
            continue;
        }

        $this->actingAs(User::factory()->create(['role' => $role->value]));

        // 403 for an existing id AND for a missing one: the `teacher`
        // middleware runs ahead of SubstituteBindings, so the route is never
        // an existence oracle for a non-teacher.
        $this->postJson("/api/generations/{$generation->id}/cancel")->assertStatus(403);
        $this->postJson('/api/generations/99999/cancel')->assertStatus(403);
    }

    expect($generation->fresh()->status)->toBe(GenerationStatus::Running)
        ->and($this->fake->calls)->toBe([]);
});
