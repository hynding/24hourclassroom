<?php

namespace App\Support;

use App\Models\Course;
use App\Models\CourseItem;
use App\Models\User;

/**
 * The two course body shapes -- TestPayload's role for courses. `view()` is
 * what every single-course response returns (show, create, update, publish,
 * unpublish), so the SPA can replace its copy wholesale after any action.
 */
final class CoursePayload
{
    /**
     * The CourseSummary row shape. Counts come from the caller's withCount
     * aliases (`tests_count`, `materials_count`), which must already be
     * restricted to what the viewer may see.
     *
     * @return array<string, mixed>
     */
    public static function summary(Course $course): array
    {
        $course->loadMissing('author');

        return [
            'id' => $course->id,
            'title' => $course->title,
            'subject' => $course->subject,
            'grade_level' => $course->grade_level,
            'visibility' => $course->visibility,
            'published_at' => $course->published_at,
            'test_count' => (int) ($course->tests_count ?? 0),
            'material_count' => (int) ($course->materials_count ?? 0),
            'author' => ['id' => $course->author->id, 'name' => $course->author->name],
        ];
    }

    /** The CourseView shape. @return array<string, mixed> */
    public static function view(Course $course, ?User $viewer): array
    {
        $course->loadMissing(['author', 'items.test' => fn ($q) => $q->withCount('questions'), 'items.material']);

        $items = $course->items
            ->filter(fn (CourseItem $item) => CourseAccess::showsItem($viewer, $course, $item))
            ->values();

        return array_merge(self::summary($course), [
            'test_count' => $items->whereNotNull('test_id')->count(),
            'material_count' => $items->whereNotNull('material_id')->count(),
            'description' => $course->description,
            'created_at' => $course->created_at,
            'updated_at' => $course->updated_at,
            'is_author' => CourseAccess::canAuthor($viewer, $course),
            'items' => $items->map(fn (CourseItem $item) => self::item($item))->all(),
        ]);
    }

    /** @return array<string, mixed> */
    private static function item(CourseItem $item): array
    {
        $base = ['id' => $item->id, 'position' => $item->position, 'section' => $item->section];

        if ($item->test !== null) {
            return $base + [
                'kind' => 'test',
                'test' => [
                    'id' => $item->test->id,
                    'title' => $item->test->title,
                    'visibility' => $item->test->visibility,
                    'question_count' => (int) $item->test->questions_count,
                ],
            ];
        }

        return $base + [
            'kind' => 'material',
            'material' => [
                'id' => $item->material->id,
                'title' => $item->material->title,
                'visibility' => $item->material->visibility,
                'original_name' => $item->material->original_name,
                'mime_type' => $item->material->mime_type,
                'size_bytes' => $item->material->size_bytes,
            ],
        ];
    }
}
