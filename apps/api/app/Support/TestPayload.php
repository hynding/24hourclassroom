<?php

namespace App\Support;

use App\Models\Test;

final class TestPayload
{
    /** @return array<string, mixed> */
    public static function for(Test $test, bool $withAnswers): array
    {
        $test->loadMissing(['author', 'questions']);

        return [
            'id' => $test->id,
            'title' => $test->title,
            'description' => $test->description,
            'subject' => $test->subject,
            'grade_level' => $test->grade_level,
            'visibility' => $test->visibility,
            'published_at' => $test->published_at,
            'copied_from_id' => $test->copied_from_id,
            'question_count' => $test->questions->count(),
            'author' => ['id' => $test->author->id, 'name' => $test->author->name],
            'questions' => $test->questions->map(fn ($q) => QuestionPayload::for($q, $withAnswers))->values()->all(),
            'created_at' => $test->created_at,
            'updated_at' => $test->updated_at,
        ];
    }
}
