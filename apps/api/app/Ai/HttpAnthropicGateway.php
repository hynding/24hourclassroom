<?php

namespace App\Ai;

use App\Ai\Exceptions\AnthropicRejected;
use App\Ai\Exceptions\AnthropicUnavailable;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

/**
 * Raw HTTPS, not the PHP SDK (spec decision 10 / ruling 5): the SDK exposes
 * neither file upload nor user.custom_tool_result, and one transport keeps the
 * real and fake gateways symmetric.
 */
class HttpAnthropicGateway implements AnthropicGateway
{
    private const BASE = 'https://api.anthropic.com';

    private const VERSION = '2023-06-01';

    private const AGENTS_BETA = 'managed-agents-2026-04-01';

    private const FILES_BETA = 'files-api-2025-04-14';

    // A session that never reaches session.status_idle (or a platform bug)
    // could hand back next_page forever; this bounds the walk so a stuck
    // session degrades to a retryable error instead of an infinite loop.
    private const MAX_EVENT_PAGES = 100;

    public function verifyKey(string $key): void
    {
        // No beta header: this proves the KEY is valid, nothing about Managed
        // Agents entitlement or credit -- those surface on the first session.
        $this->call(fn () => $this->request($key)->get(self::BASE.'/v1/models', ['limit' => 1]));
    }

    public function createEnvironment(string $key, string $name, array $config): string
    {
        return $this->requireString($this->call(fn () => $this->request($key, self::AGENTS_BETA)
            ->post(self::BASE.'/v1/environments', ['name' => $name, 'config' => $config])), 'id');
    }

    public function createAgent(string $key, array $definition): array
    {
        return $this->agent($this->call(fn () => $this->request($key, self::AGENTS_BETA)
            ->post(self::BASE.'/v1/agents', $definition)));
    }

    public function retrieveAgent(string $key, string $agentId): array
    {
        return $this->agent($this->call(fn () => $this->request($key, self::AGENTS_BETA)
            ->get(self::BASE."/v1/agents/{$agentId}")));
    }

    public function updateAgent(string $key, string $agentId, int $version, array $definition): array
    {
        // `version` is optimistic concurrency: a 409 means someone else moved
        // the agent on and the caller must re-read it.
        return $this->agent($this->call(fn () => $this->request($key, self::AGENTS_BETA)
            ->post(self::BASE."/v1/agents/{$agentId}", $definition + ['version' => $version])));
    }

    public function archiveAgent(string $key, string $agentId): void
    {
        $this->call(fn () => $this->request($key, self::AGENTS_BETA)
            ->post(self::BASE."/v1/agents/{$agentId}/archive"));
    }

    public function archiveEnvironment(string $key, string $environmentId): void
    {
        $this->call(fn () => $this->request($key, self::AGENTS_BETA)
            ->post(self::BASE."/v1/environments/{$environmentId}/archive"));
    }

    public function uploadFile(string $key, string $path, string $filename, string $mime): string
    {
        return $this->requireString($this->call(fn () => $this->request($key, self::FILES_BETA)
            ->attach('file', (string) file_get_contents($path), $filename, ['Content-Type' => $mime])
            ->post(self::BASE.'/v1/files', ['purpose' => 'agent'])), 'id');
    }

    public function deleteFile(string $key, string $fileId): void
    {
        $this->call(fn () => $this->request($key, self::FILES_BETA)
            ->delete(self::BASE."/v1/files/{$fileId}"));
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
        return $this->requireString($this->call(fn () => $this->request($key, self::AGENTS_BETA)
            ->post(self::BASE.'/v1/sessions', [
                'agent' => ['type' => 'agent', 'id' => $agentId, 'version' => $agentVersion],
                'environment_id' => $environmentId,
                'title' => $title,
                'resources' => array_values($resources),
                // The amount is an integer STRING of cents; the platform
                // rejects a number here.
                'budget' => ['type' => 'limit', 'max_list_cost' => ['amount' => (string) $budgetCents, 'currency' => 'USD']],
                // initial_events means the session is created already running,
                // so no separate "start" call can be lost.
                'initial_events' => [[
                    'type' => 'user.message',
                    'content' => [['type' => 'text', 'text' => $initialText]],
                ]],
            ])), 'id');
    }

    public function listEvents(string $key, string $sessionId): array
    {
        $events = [];
        $page = null;

        for ($fetched = 0; $fetched < self::MAX_EVENT_PAGES; $fetched++) {
            $query = $page === null ? [] : ['page' => $page];

            $response = $this->call(fn () => $this->request($key, self::AGENTS_BETA)
                ->get(self::BASE."/v1/sessions/{$sessionId}/events", $query));

            foreach ((array) $response->json('data', []) as $raw) {
                $events[] = SessionEvent::fromArray((array) $raw);
            }

            $page = $response->json('next_page');

            if (! is_string($page) || $page === '') {
                return $events;
            }
        }

        throw new AnthropicUnavailable('The event list did not terminate after 100 pages', 503);
    }

    public function sendCustomToolResult(string $key, string $sessionId, string $toolUseEventId, array $content, bool $isError): void
    {
        $this->call(fn () => $this->request($key, self::AGENTS_BETA)
            ->post(self::BASE."/v1/sessions/{$sessionId}/events", [
                'events' => [[
                    'type' => 'user.custom_tool_result',
                    // The EVENT id (sevt_...), not a tool call id.
                    'custom_tool_use_id' => $toolUseEventId,
                    'content' => $content,
                    'is_error' => $isError,
                ]],
            ]));
    }

    public function interrupt(string $key, string $sessionId): void
    {
        $this->call(fn () => $this->request($key, self::AGENTS_BETA)
            ->post(self::BASE."/v1/sessions/{$sessionId}/events", ['events' => [['type' => 'user.interrupt']]]));
    }

    public function retrieveSession(string $key, string $sessionId): array
    {
        $response = $this->call(fn () => $this->request($key, self::AGENTS_BETA)
            ->get(self::BASE."/v1/sessions/{$sessionId}"));

        $amount = $response->json('usage.list_cost.amount');

        return [
            'status' => $this->requireString($response, 'status'),
            // Cents as an integer string, already rounded by Anthropic.
            'listCostCents' => $amount === null ? null : (int) $amount,
        ];
    }

    public function archiveSession(string $key, string $sessionId): void
    {
        $this->call(fn () => $this->request($key, self::AGENTS_BETA)
            ->post(self::BASE."/v1/sessions/{$sessionId}/archive"));
    }

    private function request(string $key, ?string $beta = null): PendingRequest
    {
        $headers = ['x-api-key' => $key, 'anthropic-version' => self::VERSION];

        if ($beta !== null) {
            $headers['anthropic-beta'] = $beta;
        }

        return Http::withHeaders($headers)->connectTimeout(5)->timeout(60);
    }

    /** @return array{id: string, version: int} */
    private function agent(Response $response): array
    {
        return ['id' => $this->requireString($response, 'id'), 'version' => $this->requireInt($response, 'version')];
    }

    /**
     * Guards against a 2xx body that omits a field the caller relies on --
     * without this, a missing id or status silently casts to '' and
     * propagates as if it were a real value.
     */
    private function requireString(Response $response, string $key): string
    {
        $value = $response->json($key);

        if (! is_string($value) || $value === '') {
            throw new AnthropicUnavailable("Unexpected response from Anthropic: missing {$key}", 502);
        }

        return $value;
    }

    private function requireInt(Response $response, string $key): int
    {
        $value = $response->json($key);

        if ($value === null || $value === '' || (! is_int($value) && ! is_numeric($value))) {
            throw new AnthropicUnavailable("Unexpected response from Anthropic: missing {$key}", 502);
        }

        return (int) $value;
    }

    /**
     * ->throw() is deliberately not used: the two exception classes carry the
     * platform's own message and status, which the callers branch on.
     */
    private function call(callable $send): Response
    {
        try {
            $response = $send();
        } catch (ConnectionException $e) {
            throw new AnthropicUnavailable('Anthropic could not be reached: '.$e->getMessage(), 503);
        }

        if ($response->successful()) {
            return $response;
        }

        $status = $response->status();
        $message = (string) ($response->json('error.message') ?? "HTTP {$status}");

        throw match (true) {
            $status === 408, $status === 429, $status >= 500 => new AnthropicUnavailable($message, $status),
            default => new AnthropicRejected($message, $status),
        };
    }
}
