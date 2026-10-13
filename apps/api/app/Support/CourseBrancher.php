<?php

namespace App\Support;

use App\Models\Course;
use App\Models\CourseItem;
use App\Models\User;
use Illuminate\Support\Facades\DB;

/**
 * A teacher's own branch of someone else's public course: a new, PRIVATE
 * course with the original's title, sections and order.
 *
 * Every test is copied into the teacher's account as a private test
 * (TestCopier) -- their own questions and answers to rewrite, extend or
 * assign, which stay private until they choose otherwise. Materials are kept
 * as references to the original's public files instead: they carry no
 * answers, and copying a whole course's files would spend most of the
 * teacher's file quota (MaterialQuota) on bytes they already have.
 *
 * Only what a visitor of the original can see is branched; the original
 * itself is never touched, and later changes to it do not reach the branch.
 */
final class CourseBrancher
{
    public static function branch(Course $source, User $teacher): Course
    {
        $source->loadMissing(['items.test.questions', 'items.material.author']);

        return DB::transaction(function () use ($source, $teacher) {
            $branch = $teacher->courses()->create([
                'title' => $source->title,
                'description' => $source->description,
                'subject' => $source->subject,
                'grade_level' => $source->grade_level,
                'branched_from_id' => $source->id,
            ]);

            $items = [];
            foreach ($source->items as $item) {
                /** @var CourseItem $item */
                if (! CourseAccess::showsItem($teacher, $source, $item)) {
                    continue;
                }
                $items[] = $item->test !== null
                    ? ['kind' => 'test', 'id' => TestCopier::copy($item->test, $teacher)->id, 'section' => $item->section]
                    : ['kind' => 'material', 'id' => $item->material_id, 'section' => $item->section];
            }
            // The branch is private, so this publishes nothing.
            CourseWriter::syncItems($branch, $items);

            return $branch;
        });
    }
}
