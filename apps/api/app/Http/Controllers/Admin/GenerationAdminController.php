<?php

namespace App\Http\Controllers\Admin;

use App\Ai\CancelOutcome;
use App\Ai\GenerationCanceller;
use App\Ai\TeardownOutcome;
use App\Enums\GenerationStatus;
use App\Http\Controllers\Controller;
use App\Models\Generation;
use App\Models\Integration;
use App\Notifications\GenerationModerated;
use App\Support\AdminGenerationPayload;
use App\Support\AdminMetrics;
use App\Support\GenerationMessages;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Inertia\Response;

class GenerationAdminController extends Controller
{
    /** The one status filter value that is not an enum case: every non-terminal row. */
    private const LIVE = 'live';

    public function __construct(private readonly GenerationCanceller $canceller) {}

    public function index(Request $request): Response
    {
        $filters = $request->validate([
            'status' => ['nullable', 'string', Rule::in([self::LIVE, ...array_column(GenerationStatus::cases(), 'value')])],
            // No existence check: an empty page tells an admin nothing they
            // cannot already read off /admin/users.
            'user' => ['nullable', 'integer'],
            'leftovers' => ['nullable', 'boolean'],
        ]);

        $status = $filters['status'] ?? null;
        $userId = isset($filters['user']) ? (int) $filters['user'] : null;
        $leftovers = $request->boolean('leftovers');

        $generations = Generation::query()
            ->with('user:id,name')
            ->when($status === self::LIVE, fn ($query) => $query->live())
            ->when($status !== null && $status !== self::LIVE, fn ($query) => $query->where('status', $status))
            ->when($userId !== null, fn ($query) => $query->where('user_id', $userId))
            ->when($leftovers, fn ($query) => $query->withLeftovers())
            ->orderByDesc('created_at')
            ->orderByDesc('id')
            ->paginate(20)
            ->withQueryString()
            ->through(fn (Generation $generation) => AdminGenerationPayload::row($generation));

        return Inertia::render('admin/generations', [
            'generations' => $generations,
            'filters' => ['status' => $status, 'user' => $userId, 'leftovers' => $leftovers],
            // Sent from the server so the page never hardcodes the enum.
            'statuses' => array_column(GenerationStatus::cases(), 'value'),
            // `notice`, not `status`: `status` is already a filter and a row field.
            'notice' => $request->session()->get('notice'),
        ]);
    }

    public function show(Request $request, Generation $generation): Response
    {
        $generation->load(['user:id,name,email', 'test:id,title']);

        // The ciphertext column is non-null exactly when a key exists. Read
        // the column, never apiKey(): no admin page ever decrypts a key.
        $ownerHasKey = Integration::query()
            ->where('user_id', $generation->user_id)
            ->whereNotNull('anthropic_api_key')
            ->exists();

        return Inertia::render('admin/generation', [
            'generation' => AdminGenerationPayload::detail($generation, $ownerHasKey),
            'notice' => $request->session()->get('notice'),
        ]);
    }

    public function cancel(Generation $generation): RedirectResponse
    {
        $outcome = $this->canceller->cancel($generation, GenerationMessages::CANCELLED_BY_ADMIN);

        // The controller notifies, not the canceller: the sweep and the
        // teacher's own cancel share the canceller and must never notify.
        if ($outcome === CancelOutcome::Cancelled) {
            $generation->user->notify(new GenerationModerated($generation));
            Cache::forget(AdminMetrics::CACHE_KEY);
        }

        return $this->backWith(match ($outcome) {
            CancelOutcome::Cancelled => null,
            CancelOutcome::AlreadyTerminal => GenerationMessages::ALREADY_FINISHED,
            CancelOutcome::Busy => GenerationMessages::BUSY,
        });
    }

    public function retryTeardown(Generation $generation): RedirectResponse
    {
        $outcome = $this->canceller->retryTeardown($generation);

        if ($outcome === TeardownOutcome::Ran) {
            Cache::forget(AdminMetrics::CACHE_KEY);
        }

        return $this->backWith(match ($outcome) {
            // A keyless owner's retry spends an attempt and clears nothing;
            // without this the list looks identical and invites another click.
            TeardownOutcome::Ran => $generation->refresh()->hasLeftovers() ? GenerationMessages::LEFTOVERS_REMAIN : null,
            TeardownOutcome::NothingToDo => GenerationMessages::NO_LEFTOVERS,
            TeardownOutcome::Busy => GenerationMessages::BUSY,
        });
    }

    /** `notice`, not `status`: `status` is already a filter and a row field on these pages. */
    private function backWith(?string $notice): RedirectResponse
    {
        return $notice === null ? back() : back()->with('notice', $notice);
    }
}
