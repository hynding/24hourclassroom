<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Visibility;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Notifications\CourseModerated;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

/**
 * Public courses. Unpublishing one hides the course page only: its tests and
 * materials are moderated on their own pages, and taking one of those down
 * already removes it from every course that lists it (CourseAccess).
 */
class CourseAdminController extends Controller
{
    public function index(Request $request): Response
    {
        $filters = $request->validate(['q' => ['nullable', 'string', 'max:100']]);
        $term = $filters['q'] ?? null;

        $courses = Course::query()
            ->where('visibility', Visibility::Public)
            ->with('author')
            ->withCount('items')
            ->when($term, fn ($query, $q) => $query->where('title', 'like', '%'.addcslashes($q, '\\%_').'%'))
            ->orderByDesc('published_at')
            ->orderByDesc('id')
            ->paginate(20)
            ->withQueryString()
            ->through(fn (Course $course) => [
                'id' => $course->id,
                'title' => $course->title,
                'subject' => $course->subject,
                'grade_level' => $course->grade_level,
                'author' => ['id' => $course->author->id, 'name' => $course->author->name],
                'item_count' => $course->items_count,
                'published_at' => $course->published_at,
            ]);

        return Inertia::render('admin/courses', ['courses' => $courses, 'filters' => ['q' => $term]]);
    }

    public function unpublish(Course $course): RedirectResponse
    {
        if ($course->isPublic()) {
            $course->update(['visibility' => Visibility::Private]);
            $course->author->notify(new CourseModerated($course));
        }

        return back();
    }

    /** The course only; its tests and materials are untouched. */
    public function destroy(Course $course): RedirectResponse
    {
        $course->delete();

        return back();
    }
}
