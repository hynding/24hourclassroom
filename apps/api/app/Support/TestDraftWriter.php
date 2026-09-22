<?php

namespace App\Support;

use App\Enums\Visibility;
use App\Models\Test;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

/**
 * The one create path for a generated draft: private, owned by the author,
 * questions through C1's TestWriter. Takes the VALIDATED array, never raw
 * input, so `visibility` and any stray key cannot reach the insert.
 */
final class TestDraftWriter
{
    /** @param  array<string, mixed>  $validated */
    public static function create(User $author, array $validated): Test
    {
        return DB::transaction(function () use ($author, $validated): Test {
            $test = $author->tests()->create(
                Arr::only($validated, ['title', 'description', 'subject', 'grade_level'])
                + ['visibility' => Visibility::Private]
            );

            // TestWriter scopes every `id` lookup to THIS test, so an `id`
            // a model invented cannot touch another test's questions.
            TestWriter::syncQuestions($test, $validated['questions']);

            return $test;
        });
    }
}
