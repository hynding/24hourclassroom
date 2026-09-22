<?php

namespace App\Ai;

use App\Ai\Exceptions\AnthropicRejected;
use App\Models\Integration;
use App\Support\TestDraftSchema;
use Illuminate\Support\Str;

/**
 * Lazy, idempotent and drift-aware (spec decision 9): the first generation
 * under a key creates one environment and one agent in the teacher's own
 * organisation; later calls do nothing until the agent config hash moves, and
 * then update the agent in place.
 *
 * Re-provisioning after a 401/404 is the CALLER's job
 * (GenerationController::store clears the ids and calls ensure() again exactly
 * once), so this class never loops.
 */
class AnthropicProvisioner
{
    public function __construct(private readonly AnthropicGateway $gateway) {}

    public function ensure(Integration $integration): void
    {
        $key = (string) $integration->apiKey();

        if ($integration->anthropic_environment_id === null) {
            $integration->forceFill([
                'anthropic_environment_id' => $this->createEnvironment($key, $integration),
            ])->save();
        }

        $definition = $this->agentDefinition();
        $hash = $this->hashOf($definition);

        if ($integration->anthropic_agent_id === null) {
            $agent = $this->gateway->createAgent($key, $definition);

            $integration->forceFill([
                'anthropic_agent_id' => $agent['id'],
                'anthropic_agent_version' => $agent['version'],
                'anthropic_config_hash' => $hash,
            ])->save();

            return;
        }

        if ($integration->anthropic_config_hash === $hash) {
            return;
        }

        $agent = $this->updateAgent(
            $key,
            (string) $integration->anthropic_agent_id,
            (int) $integration->anthropic_agent_version,
            $definition,
        );

        $integration->forceFill([
            'anthropic_agent_version' => $agent['version'],
            'anthropic_config_hash' => $hash,
        ])->save();
    }

    public function environmentName(Integration $integration): string
    {
        // The suffix is what makes the name new every time: names are unique
        // per organisation and an archived one is never reusable.
        return config('generation.environment_name').'-'.$integration->user_id.'-'.Str::lower(Str::random(8));
    }

    /** @return array<string, mixed> */
    public function environmentConfig(): array
    {
        // networking `limited`, no hosts: the web tools run on Anthropic's
        // side, so the sandbox itself needs no egress.
        return ['type' => 'cloud', 'networking' => ['type' => 'limited']];
    }

    /** @return array<string, mixed> */
    public function agentDefinition(): array
    {
        return [
            'name' => config('generation.agent_name'),
            // effort is an agent property; a per-session override would be
            // silently dropped.
            'model' => ['id' => config('generation.model'), 'effort' => config('generation.effort')],
            'system' => view('generation.system')->render(),
            'tools' => [
                [
                    'type' => 'agent_toolset_20260401',
                    'default_config' => ['enabled' => false],
                    'configs' => [
                        ['name' => 'read', 'enabled' => true, 'permission_policy' => ['type' => 'always_allow']],
                        ['name' => 'web_search', 'enabled' => true, 'permission_policy' => ['type' => 'always_allow']],
                    ],
                ],
                [
                    'type' => 'custom',
                    'name' => 'save_test_draft',
                    'description' => 'Save the finished test draft. Call this exactly once, with the complete test body.',
                    'input_schema' => TestDraftSchema::json(),
                ],
            ],
        ];
    }

    public function configHash(): string
    {
        return $this->hashOf($this->agentDefinition());
    }

    /** @param  array<string, mixed>  $definition */
    private function hashOf(array $definition): string
    {
        return hash('sha256', json_encode($definition, JSON_THROW_ON_ERROR));
    }

    private function createEnvironment(string $key, Integration $integration): string
    {
        try {
            return $this->gateway->createEnvironment($key, $this->environmentName($integration), $this->environmentConfig());
        } catch (AnthropicRejected $e) {
            if ($e->status !== 409) {
                throw $e;
            }

            // A name collision only: one more try under a fresh suffix.
            return $this->gateway->createEnvironment($key, $this->environmentName($integration), $this->environmentConfig());
        }
    }

    /** @return array{id: string, version: int} */
    private function updateAgent(string $key, string $agentId, int $version, array $definition): array
    {
        try {
            return $this->gateway->updateAgent($key, $agentId, $version, $definition);
        } catch (AnthropicRejected $e) {
            if ($e->status !== 409) {
                throw $e;
            }

            // Optimistic concurrency: adopt the live version and retry once.
            $live = $this->gateway->retrieveAgent($key, $agentId);

            return $this->gateway->updateAgent($key, $agentId, (int) $live['version'], $definition);
        }
    }
}
