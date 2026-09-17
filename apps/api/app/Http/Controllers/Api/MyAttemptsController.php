<?php

namespace App\Http\Controllers\Api;

use App\Enums\Role;
use App\Http\Controllers\Controller;
use App\Models\Attempt;
use App\Support\AttemptPayload;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MyAttemptsController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $me = $request->user();
        abort_unless($me->role === Role::Student, 403);

        $rows = Attempt::where('student_id', $me->id)
            ->with('test')
            ->latest('id')
            ->get()
            ->map(fn (Attempt $a) => AttemptPayload::summary($a) + [
                'test' => [
                    'id' => $a->test->id,
                    'title' => $a->test->title,
                    'subject' => $a->test->subject,
                    'grade_level' => $a->test->grade_level,
                ],
            ])
            ->values();

        return response()->json(['data' => $rows]);
    }
}
