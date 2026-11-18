<?php

namespace App\Support;

use App\Models\Course;
use App\Models\CourseItem;
use App\Models\Material;
use App\Models\StudyProgress as Row;
use App\Models\Test;
use App\Models\User;
use Illuminate\Support\Collection;

/**
 * A learner's own progress through course content: the best and latest
 * score of their practice runs on each test, and the materials they marked
 * done. Every rule lives here.
 *
 * - Kept for a signed-in, verified `Role::tracksStudyProgress()` viewer, and
 *   never on their own content: an author previewing their course is not
 *   studying it.
 * - It is the learner's alone. Nothing returns one person's progress to
 *   anyone else -- not their teacher, guardian or an admin -- and nothing
 *   counts it into analytics (Metrics never keys on a person). Assigned
 *   work keeps its own record (attempts), which teachers do see.
 * - Keyed on the test or material, not the course: done once, done in
 *   every course that holds it, a branch's shared readings included.
 */
final class StudyProgress
{
    public static function tracks(?User $viewer): bool
    {
        return $viewer !== null && $viewer->role->tracksStudyProgress() && $viewer->hasVerifiedEmail();
    }

    /**
     * Records a finished practice run. `$marked` is the points the scorer
     * could mark (short and long answers are compared by the learner, not
     * scored), so a best of 8/8 means every marked point. Returns the row,
     * or null when nothing is kept for this viewer.
     */
    public static function recordPractice(?User $viewer, Test $test, float $score, int $marked): ?Row
    {
        if (! self::tracks($viewer) || $test->user_id === $viewer->id) {
            return null;
        }
        $row = Row::firstOrNew(['user_id' => $viewer->id, 'test_id' => $test->id]);
        $better = $row->best_max === null
            || self::fraction($score, $marked) > self::fraction((float) $row->best_score, (int) $row->best_max);
        if ($better) {
            $row->best_score = $score;
            $row->best_max = $marked;
        }
        $row->last_score = $score;
        $row->last_max = $marked;
        $row->runs = ($row->runs ?? 0) + 1;
        $row->done_at = now();
        $row->save();

        return $row;
    }

    /** Marks a material done, or not. The caller has checked the viewer may see it. */
    public static function markMaterial(User $viewer, Material $material, bool $done): ?Row
    {
        if (! self::tracks($viewer) || $material->user_id === $viewer->id) {
            return null;
        }
        if (! $done) {
            Row::where('user_id', $viewer->id)->where('material_id', $material->id)->delete();

            return null;
        }

        return Row::updateOrCreate(
            ['user_id' => $viewer->id, 'material_id' => $material->id],
            ['done_at' => now()],
        );
    }

    /** A test's practice progress, as PracticeTest/PracticeResult carry it; null when none is kept. */
    public static function forTest(?User $viewer, Test $test): ?array
    {
        if (! self::tracks($viewer) || $test->user_id === $viewer->id) {
            return null;
        }

        return self::testPayload(Row::where('user_id', $viewer->id)->where('test_id', $test->id)->first());
    }

    /** @return array<string, mixed> */
    public static function testPayload(?Row $row): array
    {
        return [
            'best_score' => $row?->best_score,
            'best_max' => $row?->best_max,
            'runs' => $row?->runs ?? 0,
            'done_at' => $row?->done_at,
        ];
    }

    /** A material's `progress` field: null when none is kept for this viewer. */
    public static function forMaterial(?User $viewer, Material $material): ?array
    {
        if (! self::tracks($viewer) || $material->user_id === $viewer->id) {
            return null;
        }

        return ['done_at' => Row::where('user_id', $viewer->id)->where('material_id', $material->id)->value('done_at')];
    }

    /**
     * The course page's map of the shown items' progress, keyed by item id
     * (CourseItem id, so the SPA needs no second lookup). Null when nothing
     * is kept: a guest, an admin, an unverified account, or the author.
     *
     * @param  Collection<int, CourseItem>  $items
     * @return array<string, mixed>|null
     */
    public static function forCourse(?User $viewer, Course $course, Collection $items): ?array
    {
        if (! self::tracks($viewer) || $course->user_id === $viewer->id) {
            return null;
        }
        $rows = Row::where('user_id', $viewer->id)
            ->where(fn ($q) => $q
                ->whereIn('test_id', $items->pluck('test_id')->filter()->all())
                ->orWhereIn('material_id', $items->pluck('material_id')->filter()->all()))
            ->get();
        $byTest = $rows->whereNotNull('test_id')->keyBy('test_id');
        $byMaterial = $rows->whereNotNull('material_id')->keyBy('material_id');

        $out = [];
        foreach ($items as $item) {
            $row = $item->test_id ? $byTest->get($item->test_id) : $byMaterial->get($item->material_id);
            if ($row === null) {
                continue;
            }
            $out[(string) $item->id] = [
                'done_at' => $row->done_at,
                'best_score' => $row->best_score,
                'best_max' => $row->best_max,
            ];
        }

        return ['items' => (object) $out];
    }

    private static function fraction(float $score, int $max): float
    {
        return $max > 0 ? $score / $max : 0.0;
    }
}
