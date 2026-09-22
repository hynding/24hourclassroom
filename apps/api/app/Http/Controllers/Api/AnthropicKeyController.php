<?php

namespace App\Http\Controllers\Api;

use App\Ai\AnthropicGateway;
use App\Ai\Exceptions\AnthropicRejected;
use App\Ai\Exceptions\AnthropicUnavailable;
use App\Ai\IntegrationTeardown;
use App\Http\Controllers\Controller;
use App\Models\Integration;
use App\Support\GenerationMessages;
use App\Support\IntegrationsPayload;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

/**
 * The role gate is the route's `teacher` middleware, which sits ahead of
 * SubstituteBindings in the priority list, so a non-teacher gets 403 before
 * any validation runs.
 */
class AnthropicKeyController extends Controller
{
    public function __construct(
        private readonly AnthropicGateway $gateway,
        private readonly IntegrationTeardown $teardown,
    ) {}

    public function update(Request $request): JsonResponse
    {
        $key = $request->validate([
            'api_key' => ['required', 'string', 'min:20', 'max:400'],
        ])['api_key'];

        $user = $request->user();

        // Verify BEFORE anything is torn down: a typo must not cost the
        // teacher their running generations.
        try {
            $this->gateway->verifyKey($key);
        } catch (AnthropicRejected) {
            throw ValidationException::withMessages(['api_key' => [GenerationMessages::KEY_REJECTED]]);
        } catch (AnthropicUnavailable) {
            return response()->json(['message' => GenerationMessages::UNREACHABLE], 503);
        }

        $integration = Integration::forUser($user);

        if ($integration->hasKey()) {
            $this->teardown->forUser($user);
        }

        // refresh(): the teardown just cleared the provisioning columns on its
        // own instance, and this one must not write the stale values back.
        $integration->refresh()->forceFill([
            'anthropic_api_key' => $key,
            'anthropic_key_hint' => substr($key, -4),
            'anthropic_key_verified_at' => now(),
        ])->save();

        $integration->clearProvisioning();

        return response()->json(IntegrationsPayload::for($user)['anthropic']);
    }

    public function destroy(Request $request): Response
    {
        $user = $request->user();

        $this->teardown->forUser($user);

        Integration::forUser($user)->forceFill([
            'anthropic_api_key' => null,
            'anthropic_key_hint' => null,
            'anthropic_key_verified_at' => null,
        ])->save();

        return response()->noContent();
    }
}
