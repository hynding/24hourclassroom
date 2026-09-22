<?php

use App\Ai\Exceptions\AnthropicRejected;
use App\Ai\Exceptions\AnthropicUnavailable;
use App\Ai\HttpAnthropicGateway;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;

beforeEach(function () {
    // The real gateway, driven entirely through Http::fake -- the only file in
    // the suite that exercises it, and it still never opens a socket.
    $this->gateway = new HttpAnthropicGateway;
    Http::preventStrayRequests();
});

test('verifyKey calls the models endpoint with the key, the version and NO beta header', function () {
    Http::fake(fn () => Http::response(['data' => []]));

    $this->gateway->verifyKey('sk-ant-abc');

    Http::assertSent(fn (Request $request) => $request->method() === 'GET'
        && $request->url() === 'https://api.anthropic.com/v1/models?limit=1'
        && $request->hasHeader('x-api-key', 'sk-ant-abc')
        && $request->hasHeader('anthropic-version', '2023-06-01')
        && ! $request->hasHeader('anthropic-beta'));
});

test('verifyKey on a 401 throws AnthropicRejected carrying the platform message', function () {
    Http::fake(fn () => Http::response(['type' => 'error', 'error' => ['type' => 'authentication_error', 'message' => 'invalid x-api-key']], 401));

    expect(fn () => $this->gateway->verifyKey('sk-ant-bad'))
        ->toThrow(AnthropicRejected::class, 'invalid x-api-key');
});

test('createEnvironment and archiveEnvironment carry the agents beta header and the exact bodies', function () {
    Http::fake(fn () => Http::response(['id' => 'env_abc']));

    $id = $this->gateway->createEnvironment('k', '24hc-generate-7-abcd1234', ['type' => 'cloud', 'networking' => ['type' => 'limited']]);

    expect($id)->toBe('env_abc');

    Http::assertSent(fn (Request $request) => $request->method() === 'POST'
        && $request->url() === 'https://api.anthropic.com/v1/environments'
        && $request->hasHeader('anthropic-beta', 'managed-agents-2026-04-01')
        && $request->data() === ['name' => '24hc-generate-7-abcd1234', 'config' => ['type' => 'cloud', 'networking' => ['type' => 'limited']]]);

    $this->gateway->archiveEnvironment('k', 'env_abc');

    Http::assertSent(fn (Request $request) => $request->method() === 'POST'
        && $request->url() === 'https://api.anthropic.com/v1/environments/env_abc/archive');
});

test('the four agent calls hit the documented URLs and updateAgent sends the version', function () {
    Http::fake(fn () => Http::response(['id' => 'agent_1', 'version' => 4]));

    expect($this->gateway->createAgent('k', ['name' => 'a']))->toBe(['id' => 'agent_1', 'version' => 4]);
    Http::assertSent(fn (Request $request) => $request->method() === 'POST'
        && $request->url() === 'https://api.anthropic.com/v1/agents'
        && $request->hasHeader('anthropic-beta', 'managed-agents-2026-04-01')
        && $request->data() === ['name' => 'a']);

    expect($this->gateway->retrieveAgent('k', 'agent_1'))->toBe(['id' => 'agent_1', 'version' => 4]);
    Http::assertSent(fn (Request $request) => $request->method() === 'GET'
        && $request->url() === 'https://api.anthropic.com/v1/agents/agent_1');

    expect($this->gateway->updateAgent('k', 'agent_1', 3, ['name' => 'a']))->toBe(['id' => 'agent_1', 'version' => 4]);
    Http::assertSent(fn (Request $request) => $request->method() === 'POST'
        && $request->url() === 'https://api.anthropic.com/v1/agents/agent_1'
        && $request->data() === ['name' => 'a', 'version' => 3]);

    $this->gateway->archiveAgent('k', 'agent_1');
    Http::assertSent(fn (Request $request) => $request->url() === 'https://api.anthropic.com/v1/agents/agent_1/archive');
});

test('a stale version is a 409 AnthropicRejected carrying the status', function () {
    Http::fake(fn () => Http::response(['error' => ['message' => 'version is stale']], 409));

    try {
        $this->gateway->updateAgent('k', 'agent_1', 1, ['name' => 'a']);
        $this->fail('expected AnthropicRejected');
    } catch (AnthropicRejected $e) {
        expect($e->getMessage())->toBe('version is stale')->and($e->status)->toBe(409);
    }
});

test('a 2xx body missing a required field is AnthropicUnavailable, not a silently empty value', function () {
    Http::fake(fn () => Http::response([], 200));

    expect(fn () => $this->gateway->createAgent('k', ['name' => 'a']))
        ->toThrow(AnthropicUnavailable::class);
});

test('uploadFile posts multipart with purpose=agent, the filename and the mime, under the files beta', function () {
    Http::fake(fn () => Http::response(['id' => 'file_xyz']));

    $id = $this->gateway->uploadFile(
        'k',
        base_path('tests/Fixtures/materials/sample.txt'),
        'cells notes.txt',
        'text/plain',
    );

    expect($id)->toBe('file_xyz');

    Http::assertSent(function (Request $request) {
        $parts = collect($request->data());
        $file = $parts->firstWhere('name', 'file');
        $purpose = $parts->firstWhere('name', 'purpose');

        return $request->method() === 'POST'
            && $request->url() === 'https://api.anthropic.com/v1/files'
            && $request->isMultipart()
            && $request->hasHeader('anthropic-beta', 'files-api-2025-04-14')
            && $file['filename'] === 'cells notes.txt'
            && $file['headers']['Content-Type'] === 'text/plain'
            && $file['contents'] === file_get_contents(base_path('tests/Fixtures/materials/sample.txt'))
            && $purpose['contents'] === 'agent';
    });
});

test('deleteFile DELETEs the file under the files beta', function () {
    Http::fake(fn () => Http::response([], 204));

    $this->gateway->deleteFile('k', 'file_xyz');

    Http::assertSent(fn (Request $request) => $request->method() === 'DELETE'
        && $request->url() === 'https://api.anthropic.com/v1/files/file_xyz'
        && $request->hasHeader('anthropic-beta', 'files-api-2025-04-14'));
});

test('createSession sends the agent, mounts, the budget as a STRING and one initial user message', function () {
    Http::fake(fn () => Http::response(['id' => 'sesn_1', 'status' => 'running']));

    $resources = [
        ['type' => 'file', 'file_id' => 'file_1', 'mount_path' => '/workspace/materials/1-cells.pdf'],
        ['type' => 'file', 'file_id' => 'file_2', 'mount_path' => '/workspace/materials/2-mitosis.pdf'],
    ];

    $id = $this->gateway->createSession('k', 'agent_1', 2, 'env_1', 'Cells quiz', $resources, 200, 'Draft a test.');

    expect($id)->toBe('sesn_1');

    Http::assertSent(function (Request $request) use ($resources) {
        $body = $request->data();

        return $request->method() === 'POST'
            && $request->url() === 'https://api.anthropic.com/v1/sessions'
            && $request->hasHeader('anthropic-beta', 'managed-agents-2026-04-01')
            && $body['agent'] === ['type' => 'agent', 'id' => 'agent_1', 'version' => 2]
            && $body['environment_id'] === 'env_1'
            && $body['title'] === 'Cells quiz'
            && $body['resources'] === $resources
            // A STRING amount: the platform rejects an integer here.
            && $body['budget'] === ['type' => 'limit', 'max_list_cost' => ['amount' => '200', 'currency' => 'USD']]
            && $body['budget']['max_list_cost']['amount'] === '200'
            && $body['initial_events'] === [[
                'type' => 'user.message',
                'content' => [['type' => 'text', 'text' => 'Draft a test.']],
            ]];
    });
});

test('listEvents follows next_page and returns mapped DTOs in server order', function () {
    Http::fake(function (Request $request) {
        if (str_contains($request->url(), 'page=page_2')) {
            return Http::response([
                'data' => [
                    ['id' => 'sevt_3', 'type' => 'session.status_idle', 'stop_reason' => ['type' => 'requires_action']],
                    ['id' => 'sevt_4', 'type' => 'session.error', 'error' => ['message' => 'boom']],
                ],
                'next_page' => null,
            ]);
        }

        return Http::response([
            'data' => [
                ['id' => 'sevt_1', 'type' => 'agent.message', 'content' => [['type' => 'text', 'text' => 'Reading '], ['type' => 'text', 'text' => 'the materials.']]],
                ['id' => 'sevt_2', 'type' => 'agent.custom_tool_use', 'name' => 'save_test_draft', 'input' => ['title' => 'Cells']],
            ],
            'next_page' => 'page_2',
        ]);
    });

    $events = $this->gateway->listEvents('k', 'sesn_1');

    expect($events)->toHaveCount(4)
        ->and(array_map(fn ($e) => $e->id, $events))->toBe(['sevt_1', 'sevt_2', 'sevt_3', 'sevt_4'])
        ->and($events[0]->text)->toBe('Reading the materials.')
        ->and($events[1]->toolName)->toBe('save_test_draft')
        ->and($events[1]->toolInput)->toBe(['title' => 'Cells'])
        ->and($events[2]->stopReasonType)->toBe('requires_action')
        ->and($events[3]->errorMessage)->toBe('boom');

    Http::assertSentCount(2);
    Http::assertSent(fn (Request $request) => $request->url() === 'https://api.anthropic.com/v1/sessions/sesn_1/events');
    Http::assertSent(fn (Request $request) => $request->url() === 'https://api.anthropic.com/v1/sessions/sesn_1/events?page=page_2');
});

test('listEvents that never terminates is bounded and reported as AnthropicUnavailable', function () {
    Http::fake(fn () => Http::response([
        'data' => [
            ['id' => 'sevt_1', 'type' => 'agent.message', 'content' => [['type' => 'text', 'text' => 'still going']]],
        ],
        'next_page' => 'page_x',
    ]));

    expect(fn () => $this->gateway->listEvents('k', 'sesn_1'))
        ->toThrow(AnthropicUnavailable::class);
});

test('sendCustomToolResult and interrupt post the documented event envelopes', function () {
    Http::fake(fn () => Http::response([]));

    $this->gateway->sendCustomToolResult('k', 'sesn_1', 'sevt_2', [['type' => 'text', 'text' => '{"ok":true}']], false);

    Http::assertSent(fn (Request $request) => $request->method() === 'POST'
        && $request->url() === 'https://api.anthropic.com/v1/sessions/sesn_1/events'
        && $request->data() === ['events' => [[
            'type' => 'user.custom_tool_result',
            'custom_tool_use_id' => 'sevt_2',
            'content' => [['type' => 'text', 'text' => '{"ok":true}']],
            'is_error' => false,
        ]]]);

    $this->gateway->interrupt('k', 'sesn_1');

    Http::assertSent(fn (Request $request) => $request->url() === 'https://api.anthropic.com/v1/sessions/sesn_1/events'
        && $request->data() === ['events' => [['type' => 'user.interrupt']]]);
});

test('retrieveSession maps the integer-string list cost, and null when the platform omits it', function () {
    // A single Http::fake() closure with a call counter, not two sequential
    // Http::fake() calls: Laravel's stub resolution is
    // stubCallbacks->map()->filter()->first(), so the FIRST registered
    // catch-all fake always wins within one test -- a second Http::fake()
    // call here would be silently ignored.
    $calls = 0;

    Http::fake(function () use (&$calls) {
        $calls++;

        return $calls === 1
            ? Http::response(['id' => 'sesn_1', 'status' => 'idle', 'usage' => ['list_cost' => ['amount' => '123', 'currency' => 'USD']]])
            : Http::response(['id' => 'sesn_1', 'status' => 'running']);
    });

    expect($this->gateway->retrieveSession('k', 'sesn_1'))->toBe(['status' => 'idle', 'listCostCents' => 123]);

    Http::assertSent(fn (Request $request) => $request->method() === 'GET'
        && $request->url() === 'https://api.anthropic.com/v1/sessions/sesn_1');

    expect($this->gateway->retrieveSession('k', 'sesn_1'))->toBe(['status' => 'running', 'listCostCents' => null]);
});

test('archiveSession posts to the archive path', function () {
    Http::fake(fn () => Http::response([]));

    $this->gateway->archiveSession('k', 'sesn_1');

    Http::assertSent(fn (Request $request) => $request->method() === 'POST'
        && $request->url() === 'https://api.anthropic.com/v1/sessions/sesn_1/archive');
});

test('429, 5xx and a transport failure are all AnthropicUnavailable', function () {
    // One Http::fake() closure keyed on call order (see the note in
    // retrieveSession's test above) so every case, including the transport
    // failure, is genuinely exercised rather than shadowed by an earlier fake.
    $calls = 0;

    Http::fake(function () use (&$calls) {
        $calls++;

        return match ($calls) {
            1 => Http::response(['error' => ['message' => 'later']], 429),
            2 => Http::response(['error' => ['message' => 'later']], 500),
            3 => Http::response(['error' => ['message' => 'later']], 503),
            // A timeout or a DNS failure never reaches a status code at all.
            default => throw new ConnectionException('timeout'),
        };
    });

    foreach ([429, 500, 503] as $status) {
        expect(fn () => $this->gateway->archiveSession('k', 'sesn_1'))
            ->toThrow(AnthropicUnavailable::class);
    }

    expect(fn () => $this->gateway->archiveSession('k', 'sesn_1'))
        ->toThrow(AnthropicUnavailable::class);
});

test('400, 401, 403, 404 and 409 are all AnthropicRejected with the body message and the status', function () {
    // One Http::fake() closure keyed on call order (see the note in
    // retrieveSession's test above), so each status in turn is genuinely
    // exercised rather than every call receiving the first-registered fake.
    $statuses = [400, 401, 403, 404, 409];
    $calls = 0;

    Http::fake(function () use ($statuses, &$calls) {
        if ($calls < count($statuses)) {
            $status = $statuses[$calls++];

            return Http::response(['error' => ['message' => "no: {$status}"]], $status);
        }

        // A body without error.message still produces a usable sentence.
        return Http::response('not json', 404);
    });

    foreach ($statuses as $status) {
        try {
            $this->gateway->retrieveSession('k', 'sesn_1');
            $this->fail("expected AnthropicRejected for {$status}");
        } catch (AnthropicRejected $e) {
            expect($e->getMessage())->toBe("no: {$status}")->and($e->status)->toBe($status);
        }
    }

    expect(fn () => $this->gateway->retrieveSession('k', 'sesn_1'))
        ->toThrow(AnthropicRejected::class, 'HTTP 404');
});
