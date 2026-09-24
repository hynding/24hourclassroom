<?php

namespace App\Ai;

/**
 * Every Anthropic call the app makes, and the only place a URL or a header
 * appears. Two implementations: HttpAnthropicGateway (raw HTTPS) and
 * FakeAnthropicGateway (tests). Every method takes the teacher's key as its
 * first argument -- there is no ambient credential, so a test can always prove
 * WHICH key a call used, which is what the key-replacement teardown turns on.
 *
 * Every method throws either AnthropicUnavailable (transport, timeout, 408,
 * 429, 5xx -- retry later) or AnthropicRejected (400/401/403/404/409/422 --
 * the request or the credential is wrong).
 */
interface AnthropicGateway
{
    public function verifyKey(string $key): void;

    public function createEnvironment(string $key, string $name, array $config): string;

    /** @return array{id: string, version: int} */
    public function createAgent(string $key, array $definition): array;

    /** @return array{id: string, version: int} */
    public function retrieveAgent(string $key, string $agentId): array;

    /** @return array{id: string, version: int} */
    public function updateAgent(string $key, string $agentId, int $version, array $definition): array;

    public function archiveAgent(string $key, string $agentId): void;

    public function archiveEnvironment(string $key, string $environmentId): void;

    /** $path is an absolute local path. @return string the Anthropic file id */
    public function uploadFile(string $key, string $path, string $filename, string $mime): string;

    public function deleteFile(string $key, string $fileId): void;

    /**
     * @param  list<array{type: 'file', file_id: string, mount_path: string}>  $resources
     * @return string the session id
     */
    public function createSession(
        string $key,
        string $agentId,
        int $agentVersion,
        string $environmentId,
        string $title,
        array $resources,
        int $budgetCents,
        string $initialText,
    ): string;

    /** @return list<SessionEvent> every page, in server order */
    public function listEvents(string $key, string $sessionId): array;

    public function sendCustomToolResult(string $key, string $sessionId, string $toolUseEventId, array $content, bool $isError): void;

    public function interrupt(string $key, string $sessionId): void;

    /** @return array{status: string, listCostCents: ?int} */
    public function retrieveSession(string $key, string $sessionId): array;

    public function archiveSession(string $key, string $sessionId): void;
}
