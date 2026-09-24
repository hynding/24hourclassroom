<?php

namespace App\Ai;

use App\Ai\Exceptions\AnthropicRejected;
use Throwable;

/**
 * The scripted gateway every generation test runs against.
 *
 * THE INVARIANT: every method calls record() FIRST -- which appends
 * func_get_args() to $calls[$method] -- and only THEN honours a queued
 * failNext(). So argument 0 of every recorded call is the API key that was
 * used, even for a call that went on to throw, which is what lets
 * IntegrationKeyTest prove a key replacement tore the old resources down under
 * the OLD key.
 *
 * Ids are deterministic and per-prefix: env_1, agent_1, file_1, file_2, sesn_1.
 */
class FakeAnthropicGateway implements AnthropicGateway
{
    /** method => list of func_get_args() arrays. @var array<string, list<array<int, mixed>>> */
    public array $calls = [];

    /** agent id => current version. @var array<string, int> */
    public array $agents = [];

    /** Every environment name ever created, for the uniqueness 409. @var list<string> */
    public array $environmentNames = [];

    /** session id => events, oldest first. @var array<string, list<SessionEvent>> */
    public array $events = [];

    /** method => the exceptions the next calls throw, in order. @var array<string, list<Throwable>> */
    private array $failures = [];

    /** Successive retrieveSession statuses; the last entry repeats. @var list<string> */
    private array $statuses = ['idle'];

    private ?int $sessionCost = null;

    private bool $rejectKeys = false;

    /** @var array<string, int> */
    private array $counters = [];

    // ---- scripting ------------------------------------------------------

    /** @param  list<SessionEvent|array<string, mixed>>  $events */
    public function queueEvents(string $sessionId, array $events): void
    {
        foreach ($events as $event) {
            $this->events[$sessionId][] = $event instanceof SessionEvent
                ? $event
                : SessionEvent::fromArray($event);
        }
    }

    /** Arm one failure for the next call of $method; arming twice fails twice. */
    public function failNext(string $method, Throwable $e): void
    {
        $this->failures[$method][] = $e;
    }

    public function rejectKeys(): void
    {
        $this->rejectKeys = true;
    }

    public function returnsSessionCost(int $cents): void
    {
        $this->sessionCost = $cents;
    }

    public function returnsSessionStatus(string $status): void
    {
        $this->statuses = [$status];
    }

    /** @param  list<string>  $statuses */
    public function returnsSessionStatuses(array $statuses): void
    {
        $this->statuses = array_values($statuses);
    }

    // ---- gateway --------------------------------------------------------

    public function verifyKey(string $key): void
    {
        $this->record('verifyKey', func_get_args());

        if ($this->rejectKeys) {
            throw new AnthropicRejected('invalid x-api-key', 401);
        }
    }

    public function createEnvironment(string $key, string $name, array $config): string
    {
        $this->record('createEnvironment', func_get_args());

        if (in_array($name, $this->environmentNames, true)) {
            throw new AnthropicRejected('name taken', 409);
        }

        $this->environmentNames[] = $name;

        return $this->nextId('env');
    }

    public function createAgent(string $key, array $definition): array
    {
        $this->record('createAgent', func_get_args());

        $id = $this->nextId('agent');
        $this->agents[$id] = 1;

        return ['id' => $id, 'version' => 1];
    }

    public function retrieveAgent(string $key, string $agentId): array
    {
        $this->record('retrieveAgent', func_get_args());

        if (! isset($this->agents[$agentId])) {
            throw new AnthropicRejected('not found', 404);
        }

        return ['id' => $agentId, 'version' => $this->agents[$agentId]];
    }

    public function updateAgent(string $key, string $agentId, int $version, array $definition): array
    {
        $this->record('updateAgent', func_get_args());

        if (! isset($this->agents[$agentId])) {
            throw new AnthropicRejected('not found', 404);
        }

        if ($this->agents[$agentId] !== $version) {
            throw new AnthropicRejected('stale version', 409);
        }

        return ['id' => $agentId, 'version' => ++$this->agents[$agentId]];
    }

    public function archiveAgent(string $key, string $agentId): void
    {
        $this->record('archiveAgent', func_get_args());
    }

    public function archiveEnvironment(string $key, string $environmentId): void
    {
        $this->record('archiveEnvironment', func_get_args());
    }

    public function uploadFile(string $key, string $path, string $filename, string $mime): string
    {
        $this->record('uploadFile', func_get_args());

        return $this->nextId('file');
    }

    public function deleteFile(string $key, string $fileId): void
    {
        $this->record('deleteFile', func_get_args());
    }

    public function createSession(
        string $key,
        string $agentId,
        int $agentVersion,
        string $environmentId,
        string $title,
        array $resources,
        int $budgetCents,
        string $initialText,
    ): string {
        $this->record('createSession', func_get_args());

        return $this->nextId('sesn');
    }

    public function listEvents(string $key, string $sessionId): array
    {
        $this->record('listEvents', func_get_args());

        return $this->events[$sessionId] ?? [];
    }

    public function sendCustomToolResult(string $key, string $sessionId, string $toolUseEventId, array $content, bool $isError): void
    {
        $this->record('sendCustomToolResult', func_get_args());
    }

    public function interrupt(string $key, string $sessionId): void
    {
        $this->record('interrupt', func_get_args());
    }

    public function retrieveSession(string $key, string $sessionId): array
    {
        $this->record('retrieveSession', func_get_args());

        $index = min(count($this->calls['retrieveSession']) - 1, count($this->statuses) - 1);

        return ['status' => $this->statuses[$index], 'listCostCents' => $this->sessionCost];
    }

    public function archiveSession(string $key, string $sessionId): void
    {
        $this->record('archiveSession', func_get_args());
    }

    // ---- internals ------------------------------------------------------

    /** @param  array<int, mixed>  $args */
    private function record(string $method, array $args): void
    {
        $this->calls[$method][] = $args;

        if (! empty($this->failures[$method])) {
            throw array_shift($this->failures[$method]);
        }
    }

    private function nextId(string $prefix): string
    {
        $this->counters[$prefix] = ($this->counters[$prefix] ?? 0) + 1;

        return $prefix.'_'.$this->counters[$prefix];
    }
}
