<?php

namespace App\Http\Controllers\Admin;

use App\Enums\TestVisibility;
use App\Http\Controllers\Controller;
use App\Models\Test;
use App\Notifications\TestModerated;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class TestAdminController extends Controller
{
    public function index(Request $request): Response
    {
        $filters = $request->validate(['q' => ['nullable', 'string', 'max:100']]);
        $term = $filters['q'] ?? null;

        $tests = Test::query()
            ->where('visibility', TestVisibility::Public)
            ->with('author')
            ->withCount('questions')
            ->when($term, fn ($query, $q) => $query->where('title', 'like', '%'.addcslashes($q, '\\%_').'%'))
            ->orderByDesc('published_at')
            ->orderByDesc('id')
            ->paginate(20)
            ->withQueryString()
            ->through(fn (Test $test) => [
                'id' => $test->id,
                'title' => $test->title,
                'subject' => $test->subject,
                'grade_level' => $test->grade_level,
                'author' => ['id' => $test->author->id, 'name' => $test->author->name],
                'question_count' => $test->questions_count,
                'published_at' => $test->published_at,
            ]);

        return Inertia::render('admin/tests', ['tests' => $tests, 'filters' => ['q' => $term]]);
    }

    public function unpublish(Test $test): RedirectResponse
    {
        if ($test->isPublic()) {
            $test->update(['visibility' => TestVisibility::Private]);
            $test->author->notify(new TestModerated($test));
        }

        return back();
    }

    public function destroy(Test $test): RedirectResponse
    {
        $test->delete();

        return back();
    }
}
