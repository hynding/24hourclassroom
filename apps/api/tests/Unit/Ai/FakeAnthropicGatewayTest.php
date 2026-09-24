<?php

use App\Ai\Exceptions\AnthropicRejected;
use App\Ai\Exceptions\AnthropicUnavailable;
use App\Ai\FakeAnthropicGateway;
use App\Ai\SessionEvent;

beforeEach(function () {
    $this->fake = new FakeAnthropicGateway;
});

test('failNext throws once, and the call is recorded with its key even so', function () {
    $this->fake->failNext('archiveSession', new AnthropicUnavailable('down', 503));

    expect(fn () => $this->fake->archiveSession('key-a', 'sesn_1'))->toThrow(AnthropicUnavailable::class);

    // Recorded FIRST, then the failure: a test can still prove which key the
    // failed call used.
    expect($this->fake->calls['archiveSession'][0])->toBe(['key-a', 'sesn_1']);

    // The second call goes through -- failNext is a one-shot.
    $this->fake->archiveSession('key-a', 'sesn_1');
    expect($this->fake->calls['archiveSession'])->toHaveCount(2);

    // Two armed failures fail the next two calls, in order: GenerationCreateTest
    // needs createSession to fail twice to prove the re-provision is once only.
    $this->fake->failNext('interrupt', new AnthropicUnavailable('first', 503));
    $this->fake->failNext('interrupt', new AnthropicUnavailable('second', 503));

    expect(fn () => $this->fake->interrupt('key-a', 'sesn_1'))->toThrow(AnthropicUnavailable::class, 'first');
    expect(fn () => $this->fake->interrupt('key-a', 'sesn_1'))->toThrow(AnthropicUnavailable::class, 'second');

    $this->fake->interrupt('key-a', 'sesn_1');
    expect($this->fake->calls['interrupt'])->toHaveCount(3);
});

test('queueEvents is cumulative and accepts raw arrays or DTOs', function () {
    $this->fake->queueEvents('sesn_1', [
        ['id' => 'sevt_1', 'type' => 'agent.message', 'content' => [['type' => 'text', 'text' => 'hi']]],
    ]);

    expect($this->fake->listEvents('k', 'sesn_1'))->toHaveCount(1);

    $this->fake->queueEvents('sesn_1', [new SessionEvent(id: 'sevt_2', type: 'session.status_terminated')]);

    $events = $this->fake->listEvents('k', 'sesn_1');

    // The real endpoint returns the whole history every time; so does this.
    expect($events)->toHaveCount(2)
        ->and($events[0]->text)->toBe('hi')
        ->and($events[1]->id)->toBe('sevt_2')
        ->and($this->fake->listEvents('k', 'sesn_unknown'))->toBe([]);
});

test('updateAgent 409s on a stale version and retrieveAgent reports the live one', function () {
    $agent = $this->fake->createAgent('k', ['name' => 'a']);

    expect($agent)->toBe(['id' => 'agent_1', 'version' => 1]);

    expect($this->fake->updateAgent('k', 'agent_1', 1, ['name' => 'b']))->toBe(['id' => 'agent_1', 'version' => 2]);

    try {
        $this->fake->updateAgent('k', 'agent_1', 1, ['name' => 'c']);
        $this->fail('expected AnthropicRejected');
    } catch (AnthropicRejected $e) {
        expect($e->status)->toBe(409);
    }

    expect($this->fake->retrieveAgent('k', 'agent_1'))->toBe(['id' => 'agent_1', 'version' => 2]);
    expect(fn () => $this->fake->retrieveAgent('k', 'agent_9'))->toThrow(AnthropicRejected::class, 'not found');
});

test('ids increment per prefix, names collide with a 409, and the session scripting answers in order', function () {
    expect($this->fake->createEnvironment('k', 'env-one', []))->toBe('env_1')
        ->and($this->fake->createEnvironment('k', 'env-two', []))->toBe('env_2')
        ->and($this->fake->uploadFile('k', '/tmp/a', 'a.pdf', 'application/pdf'))->toBe('file_1')
        ->and($this->fake->uploadFile('k', '/tmp/b', 'b.pdf', 'application/pdf'))->toBe('file_2')
        ->and($this->fake->createSession('k', 'agent_1', 1, 'env_1', 't', [], 200, 'brief'))->toBe('sesn_1');

    // Environment names are unique per organisation, so a reuse is a 409.
    expect(fn () => $this->fake->createEnvironment('k', 'env-one', []))
        ->toThrow(AnthropicRejected::class, 'name taken');

    // Default: idle, so no teardown test ever waits.
    expect($this->fake->retrieveSession('k', 'sesn_1'))->toBe(['status' => 'idle', 'listCostCents' => null]);

    $fresh = new FakeAnthropicGateway;
    $fresh->returnsSessionStatuses(['running', 'idle']);
    $fresh->returnsSessionCost(150);

    expect($fresh->retrieveSession('k', 'sesn_1')['status'])->toBe('running')
        ->and($fresh->retrieveSession('k', 'sesn_1')['status'])->toBe('idle')
        // The last entry repeats for ever.
        ->and($fresh->retrieveSession('k', 'sesn_1'))->toBe(['status' => 'idle', 'listCostCents' => 150]);

    $rejecting = new FakeAnthropicGateway;
    $rejecting->rejectKeys();
    expect(fn () => $rejecting->verifyKey('k'))->toThrow(AnthropicRejected::class, 'invalid x-api-key');
});
