<?php

namespace App\Http\Controllers\Api;

use App\Ai\AnthropicGateway;
use App\Ai\AnthropicProvisioner;
use App\Ai\Exceptions\AnthropicRejected;
use App\Ai\Exceptions\AnthropicUnavailable;
use App\Ai\SessionTeardown;
use App\Enums\GenerationStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGenerationRequest;
use App\Models\Generation;
use App\Models\Integration;
use App\Models\Material;
use App\Support\GenerationMessages;
use App\Support\GenerationPayload;
use App\Support\MaterialAccess;
use App\Support\TaxonomyLabels;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class GenerationController extends Controller
{
    public function __construct(
        private readonly AnthropicGateway $gateway,
        private readonly AnthropicProvisioner $provisioner,
        private readonly SessionTeardown $teardown,
    ) {}

    /**
     * The heaviest request in the app: provision, upload every material, open
     * the session. Deliberately NOT wrapped in a transaction -- each gateway
     * call may take up to 60 s, and the file ids must be committed as they are
     * learned so a request that dies mid-way still leaves the teardown
     * something to clean up.
     */
    public function store(StoreGenerationRequest $request): JsonResponse
    {
        $user = $request->user();
        $data = $request->validated();

        $integration = Integration::forUser($user);

        if (! $integration->hasKey()) {
            throw ValidationException::withMessages(['api_key' => [GenerationMessages::KEY_REQUIRED]]);
        }

        $ids = array_values(array_map('intval', $data['material_ids']));
        $materials = Material::whereIn('id', $ids)->get();

        // 404, never 403 and never 422: a missing id, a stranger's material and
        // one merely SHARED with this teacher are indistinguishable. Shared
        // material is theirs to read, not to export into a third-party
        // organisation (spec decision 5).
        abort_unless($materials->count() === count($ids), 404);

        foreach ($materials as $material) {
            abort_unless(MaterialAccess::canAuthor($user, $material), 404);
        }

        // The caller's order is the mount order, and the brief names the paths
        // in that order.
        $ordered = array_map(fn (int $id) => $materials->firstWhere('id', $id), $ids);

        $generation = $user->generations()->create([
            'title' => $data['title'],
            'subject' => $data['subject'],
            'grade_level' => $data['grade_level'],
            'instructions' => $data['instructions'] ?? null,
            'question_count' => (int) $data['question_count'],
            'material_ids' => $ids,
            'status' => GenerationStatus::Queued,
        ]);

        try {
            $this->provisioner->ensure($integration);

            $fileIds = [];
            $resources = [];

            foreach ($ordered as $index => $material) {
                $fileIds[] = $fileId = $this->gateway->uploadFile(
                    (string) $integration->apiKey(),
                    Storage::disk(config('materials.disk'))->path($material->path),
                    $material->original_name,
                    $material->mime_type,
                );

                $resources[] = [
                    'type' => 'file',
                    'file_id' => $fileId,
                    'mount_path' => rtrim((string) config('generation.mount_dir'), '/').'/'.($index + 1).'-'.$material->original_name,
                ];

                // Committed as each id is learned: a crash on the next upload
                // must not orphan the ones already made.
                $generation->forceFill(['file_ids' => $fileIds])->save();
            }

            $sessionId = $this->openSession($integration, $generation, $resources);

            $generation->forceFill([
                'session_id' => $sessionId,
                'status' => GenerationStatus::Running,
                'started_at' => now(),
            ])->save();
        } catch (AnthropicUnavailable|AnthropicRejected $e) {
            // Still 201: the row exists and the SPA navigates to it to read the
            // failure, exactly as it would for a run that failed later.
            $generation->markTerminal(GenerationStatus::Failed, GenerationMessages::CREATE_FAILED.': '.$e->getMessage());
            $this->teardown->run($generation);
        }

        return response()->json(GenerationPayload::for($generation->fresh()), 201);
    }

    /**
     * A 401 or 404 here means the stored agent or environment is gone, or the
     * key moved organisation. Re-provision ONCE, then let a second failure
     * fail the row.
     */
    private function openSession(Integration $integration, Generation $generation, array $resources): string
    {
        try {
            return $this->createSession($integration, $generation, $resources);
        } catch (AnthropicRejected $e) {
            if ($e->status !== 401 && $e->status !== 404) {
                throw $e;
            }

            $integration->clearProvisioning();
            $this->provisioner->ensure($integration);

            return $this->createSession($integration, $generation, $resources);
        }
    }

    private function createSession(Integration $integration, Generation $generation, array $resources): string
    {
        return $this->gateway->createSession(
            (string) $integration->apiKey(),
            (string) $integration->anthropic_agent_id,
            (int) $integration->anthropic_agent_version,
            (string) $integration->anthropic_environment_id,
            $generation->title,
            $resources,
            (int) config('generation.budget_cents'),
            $this->brief($generation, $resources),
        );
    }

    private function brief(Generation $generation, array $resources): string
    {
        return view('generation.brief', [
            'subject' => self::label(TaxonomyLabels::subjects(), $generation->subject->value),
            'gradeLevel' => self::label(TaxonomyLabels::gradeLevels(), $generation->grade_level->value),
            'questionCount' => $generation->question_count,
            'instructions' => $generation->instructions,
            'paths' => array_column($resources, 'mount_path'),
        ])->render();
    }

    /** @param  list<array{value: string, label: string}>  $options */
    private static function label(array $options, string $value): string
    {
        foreach ($options as $option) {
            if (($option['value'] ?? null) === $value) {
                return (string) ($option['label'] ?? $value);
            }
        }

        return $value;
    }
}
