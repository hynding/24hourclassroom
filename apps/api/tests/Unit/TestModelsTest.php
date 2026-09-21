<?php

use App\Enums\QuestionType;
use App\Models\Question;

test('a question soft-deletes and is hidden from the test but reachable from an answer', function () {
    $author = aTeacher();
    $test = aTestWithQuestions($author, 2);
    $q = $test->questions->first();
    $q->delete();

    expect($test->fresh()->questions)->toHaveCount(1)
        ->and(Question::withTrashed()->find($q->id))->not->toBeNull();
});

test('question casts round-trip scalar and structured answers', function () {
    $test = aTestWithQuestions(aTeacher(), 0);
    $tf = Question::factory()->for($test)->trueFalse()->create();
    $num = Question::factory()->for($test)->numeric(3.5, 0.1)->create();

    expect($tf->fresh()->answer)->toBeTrue()
        ->and($tf->fresh()->type)->toBe(QuestionType::TrueFalse)
        ->and($num->fresh()->answer)->toBe(['value' => 3.5, 'tolerance' => 0.1]);
});
