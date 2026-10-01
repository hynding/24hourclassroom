<?php

namespace App\Http\Controllers\Api;

use App\Ai\CancelOutcome;
use App\Ai\GenerationCanceller;
use App\Http\Controllers\Controller;
use App\Models\Generation;
use App\Support\GenerationAccess;
use App\Support\GenerationMessages;
use App\Support\GenerationPayload;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GenerationCancelController extends Controller
{
    public function __construct(private readonly GenerationCanceller $canceller) {}

    public function __invoke(Request $request, Generation $generation): JsonResponse
    {
        GenerationAccess::assertOwner($request->user(), $generation);

        // No error text: a user cancel is not a failure. AlreadyTerminal is a
        // 200 with the row as it is -- the canceller re-read it under the lock.
        if ($this->canceller->cancel($generation, null) === CancelOutcome::Busy) {
            return response()->json(['message' => GenerationMessages::BUSY], 409);
        }

        return response()->json(GenerationPayload::for($generation->fresh()));
    }
}
