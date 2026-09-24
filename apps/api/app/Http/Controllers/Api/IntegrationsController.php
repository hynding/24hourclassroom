<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Support\IntegrationsPayload;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class IntegrationsController extends Controller
{
    /** The role gate is the route's `teacher` middleware. */
    public function show(Request $request): JsonResponse
    {
        return response()->json(IntegrationsPayload::for($request->user()));
    }
}
