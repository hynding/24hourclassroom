<?php

namespace App\Http\Controllers\Admin;

use App\Enums\GenerationStatus;
use App\Http\Controllers\Controller;
use App\Models\Generation;
use App\Models\Integration;
use App\Support\AdminGenerationPayload;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Inertia\Response;

class GenerationAdminController extends Controller
{
    /** The one status filter value that is not an enum case: every non-terminal row. */
    private const LIVE = 'live';

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
}
