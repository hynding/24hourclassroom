<?php

namespace App\Support;

use App\Enums\Visibility;
use App\Models\Course;
use App\Models\Material;
use App\Models\Test;

/**
 * Writes a course's item list, and the one rule tying a course's visibility
 * to its contents: a visitor sees only public items (CourseAccess), so
 * publishing a course publishes everything in it, and adding to a public
 * course publishes what is added. Nothing more: an item its author
 * unpublishes afterwards stays private -- hidden from visitors, marked for
 * the author -- until they publish it again. Saving the course never
 * overrides that choice behind their back.
 */
final class CourseWriter
{
    /**
     * Replace the course's item list with `$items` (already validated by
     * SaveCourseRequest: each `id` is one of the author's own tests or
     * materials, and none repeats). Nothing points at a course_items row, so
     * the list is rewritten rather than diffed.
     *
     * @param  array<int, array{kind: string, id: int, section?: string|null}>  $items
     */
    public static function syncItems(Course $course, array $items): void
    {
        // Same reason as TestWriter: validated() can reorder keys.
        ksort($items);
        $before = self::contents($course);

        $course->items()->delete();
        foreach (array_values($items) as $position => $item) {
            $course->items()->create([
                'position' => $position,
                'section' => filled($item['section'] ?? null) ? trim($item['section']) : null,
                'test_id' => $item['kind'] === 'test' ? (int) $item['id'] : null,
                'material_id' => $item['kind'] === 'material' ? (int) $item['id'] : null,
            ]);
        }
        $course->unsetRelation('items');

        if ($course->isPublic()) {
            $after = self::contents($course);
            self::publish($course, array_diff($after['test'], $before['test']), array_diff($after['material'], $before['material']));
        }
    }

    /** Everything in the course, on publish (and on the author's "publish hidden items"). */
    public static function publishContents(Course $course): void
    {
        $contents = self::contents($course);
        self::publish($course, $contents['test'], $contents['material']);
    }

    /** @return array{test: list<int>, material: list<int>} */
    private static function contents(Course $course): array
    {
        return [
            'test' => $course->items()->whereNotNull('test_id')->pluck('test_id')->all(),
            'material' => $course->items()->whereNotNull('material_id')->pluck('material_id')->all(),
        ];
    }

    /**
     * Only the author's own rows: CourseAccess never shows anyone else's,
     * and this must never publish them either. A test with no questions
     * cannot be published (TestPublishController's rule) and stays private
     * until it has some.
     *
     * @param  array<int, int>  $testIds
     * @param  array<int, int>  $materialIds
     */
    private static function publish(Course $course, array $testIds, array $materialIds): void
    {
        if ($testIds !== []) {
            Test::query()
                ->whereIn('id', $testIds)
                ->where('user_id', $course->user_id)
                ->where('visibility', Visibility::Private)
                ->whereHas('questions')
                ->update(['visibility' => Visibility::Public, 'published_at' => now()]);
        }

        if ($materialIds !== []) {
            Material::query()
                ->whereIn('id', $materialIds)
                ->where('user_id', $course->user_id)
                ->where('visibility', Visibility::Private)
                ->update(['visibility' => Visibility::Public, 'published_at' => now()]);
        }
    }
}
