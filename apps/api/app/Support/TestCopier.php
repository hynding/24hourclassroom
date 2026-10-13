<?php

namespace App\Support;

use App\Enums\Visibility;
use App\Models\Test;
use App\Models\User;

/**
 * A private copy of a test, owned by `$owner`: the "Copy to my tests" button
 * and every test of a branched course both come through here. The caller
 * has already decided the copy is allowed, and wraps it in a transaction.
 */
final class TestCopier
{
    public static function copy(Test $source, User $owner): Test
    {
        $copy = $owner->tests()->create([
            'title' => $source->title,
            'description' => $source->description,
            'subject' => $source->subject,
            'grade_level' => $source->grade_level,
            'visibility' => Visibility::Private,
            'copied_from_id' => $source->id,
        ]);
        foreach ($source->questions as $q) {
            // Not `slug`: a copy is a different test, and the seeder's
            // re-run must find its own rows, never a teacher's copy.
            $copy->questions()->create($q->only([
                'position', 'type', 'prompt', 'stimulus', 'options', 'option_explanations',
                'answer', 'points', 'partial_credit', 'auto_grade', 'explanation',
            ]));
        }

        return $copy;
    }
}
