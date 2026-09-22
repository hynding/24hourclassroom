<?php

namespace App\Http\Controllers\Api;

use App\Ai\SessionTeardown;
use App\Enums\GenerationStatus;
use App\Http\Controllers\Controller;
use App\Models\Generation;
use App\Support\GenerationAccess;
use App\Support\GenerationMessages;
use App\Support\GenerationPayload;
use Illuminate\Contracts\Cache\LockTimeoutException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class GenerationCancelController extends Controller
{
    public function __construct(private readonly SessionTeardown $teardown) {}

    public function __invoke(Request $request, Generation $generation): JsonResponse
    {
        GenerationAccess::assertOwner($request->user(), $generation);

        // The same lock a poll takes, but blocking: a cancel is a deliberate
        // user action and is worth waiting a few seconds for. The lifetime
        // exceeds the worst-case advance (a multi-page listEvents plus one
        // send, each bounded by the 60 s request timeout).
        $lock = Cache::lock($generation->lockKey(), 180);

        try {
            $lock->block(5);
        } catch (LockTimeoutException) {
            return response()->json(['message' => GenerationMessages::BUSY], 409);
        }

        try {
            // The route bound $generation before the block above could have
            // waited; re-read what the lock actually protects before trusting
            // its status, or a concurrent holder's terminal write is undone.
            $generation->refresh();

            if (! $generation->isTerminal()) {
                $this->teardown->run($generation);
                // No error text: a user cancel is not a failure.
                $generation->markTerminal(GenerationStatus::Cancelled);
            }
        } finally {
            $lock->release();
        }

        return response()->json(GenerationPayload::for($generation->fresh()));
    }
}
