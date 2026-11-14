<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User;
use App\Support\CourseAccess;
use App\Support\CoursePayload;
use App\Support\Slugs;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/** Vanity paths: resolving them, a teacher's handle, a course's slug. Rules in Slugs. */
class SlugController extends Controller
{
    /** GET /api/resolve?path= -- 404 for anything the viewer could not open by id. */
    public function resolve(Request $request): JsonResponse
    {
        $path = $request->query('path');
        abort_unless(is_string($path) && strlen($path) <= 200, 404);
        $result = Slugs::resolve(rtrim($path, '/'), $request->user());
        abort_if($result === null, 404);

        return response()->json($result);
    }

    public function showHandle(Request $request): JsonResponse
    {
        return response()->json(self::handleState($request->user()));
    }

    /** Teachers and tutors only (Role::isPublic(): only they have a public page to name). */
    public function updateHandle(Request $request): JsonResponse
    {
        $user = $request->user();
        abort_unless($user->role->isPublic(), 403);
        $data = $request->validate(['handle' => ['present', 'nullable', 'string', 'max:'.Slugs::MAX]]);

        $data['handle'] === null
            ? Slugs::withdrawPendingHandle($user)
            : Slugs::requestHandle($user, strtolower(trim($data['handle'])));

        return response()->json(self::handleState($user));
    }

    /** The author names the course under their handle; null clears it. */
    public function updateCourse(Request $request, Course $course): JsonResponse
    {
        $user = $request->user();
        CourseAccess::assertAuthor($user, $course);
        $data = $request->validate(['slug' => ['present', 'nullable', 'string', 'max:'.Slugs::MAX]]);

        Slugs::setCourseSlug($course, $data['slug'] === null ? null : strtolower(trim($data['slug'])));

        return response()->json(CoursePayload::view($course->fresh(), $user));
    }

    /** @return array{handle: ?string, path: string, request: array{slug: string, status: string}|null} */
    public static function handleState(User $user): array
    {
        $request = Slugs::handleRequest($user);

        return [
            'handle' => Slugs::handle($user),
            'path' => Slugs::teacherPath($user),
            // The newest request: pending, rejected, or the approved handle itself.
            'request' => $request ? ['slug' => $request->slug, 'status' => $request->status->value] : null,
        ];
    }
}
