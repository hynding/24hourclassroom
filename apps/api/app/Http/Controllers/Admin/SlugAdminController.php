<?php

namespace App\Http\Controllers\Admin;

use App\Enums\SlugKind;
use App\Enums\SlugStatus;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\UrlSlug;
use App\Support\FrontendRedirect;
use App\Support\Slugs;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

/**
 * /admin/slugs: approve teacher handles, set site-wide course addresses.
 * Course slugs under a handle need no review: they go live once the handle
 * is approved (Slugs::approveHandle).
 */
class SlugAdminController extends Controller
{
    public function index(): Response
    {
        $row = fn (UrlSlug $slug) => [
            'id' => $slug->id,
            'kind' => $slug->kind->value,
            'slug' => $slug->slug,
            'status' => $slug->status->value,
            'user' => $slug->user ? ['id' => $slug->user->id, 'name' => $slug->user->name, 'email' => $slug->user->email] : null,
            'course' => $slug->course ? ['id' => $slug->course->id, 'title' => $slug->course->title] : null,
            'created_at' => $slug->created_at,
            'reviewed_at' => $slug->reviewed_at,
        ];

        return Inertia::render('admin/slugs', [
            'spa_origin' => FrontendRedirect::spaOrigin(),
            'pending' => UrlSlug::with('user')->where('kind', SlugKind::Teacher)->where('status', SlugStatus::Pending)
                ->orderBy('id')->get()->map($row),
            'handles' => UrlSlug::with('user')->where('kind', SlugKind::Teacher)->where('status', SlugStatus::Approved)
                ->orderBy('slug')->get()->map($row),
            'site' => UrlSlug::with('course')->where('kind', SlugKind::SiteCourse)->whereIn('status', SlugStatus::resolving())
                ->orderBy('slug')->get()->map($row),
        ]);
    }

    public function approve(Request $request, UrlSlug $slug): RedirectResponse
    {
        Slugs::approveHandle($slug, $request->user());

        return back();
    }

    public function reject(Request $request, UrlSlug $slug): RedirectResponse
    {
        Slugs::rejectHandle($slug, $request->user());

        return back();
    }

    /** Sets or (slug: null) retires a course's /courses/<slug> address. */
    public function siteCourse(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'course_id' => ['required', 'integer', 'exists:courses,id'],
            'slug' => ['present', 'nullable', 'string', 'max:'.Slugs::MAX],
        ]);

        Slugs::setSiteSlug(Course::findOrFail($data['course_id']), $data['slug'] === null ? null : strtolower(trim($data['slug'])), $request->user());

        return back();
    }
}
