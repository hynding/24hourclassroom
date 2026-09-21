<?php

use App\Models\Attempt;
use App\Support\AttemptPayload;

test('latest/best tie-break on a same-second submitted_at resolves to the higher id, regardless of caller order', function () {
    $teacher = aTeacher();
    $test = aTestWithQuestions($teacher, 1);
    $student = aStudent();

    $same = now();

    $a = Attempt::create(['test_id' => $test->id, 'student_id' => $student->id, 'started_at' => $same]);
    $a->forceFill(['submitted_at' => $same, 'score' => 5, 'max_score' => 10, 'graded_at' => $same])->save();

    $b = Attempt::create(['test_id' => $test->id, 'student_id' => $student->id, 'started_at' => $same]);
    $b->forceFill(['submitted_at' => $same, 'score' => 3, 'max_score' => 10, 'graded_at' => $same])->save();

    // Ascending order (as an unordered `attempts` relation load would return
    // it) to prove the helper no longer depends on caller ordering.
    $result = AttemptPayload::latestAndBest(collect([$a, $b]));

    expect($result['latest']['id'])->toBe($b->id)
        ->and($result['best']['id'])->toBe($a->id);
});

test('a same-second, same-score tie for best resolves to the most recent attempt', function () {
    $teacher = aTeacher();
    $test = aTestWithQuestions($teacher, 1);
    $student = aStudent();

    $same = now();

    $a = Attempt::create(['test_id' => $test->id, 'student_id' => $student->id, 'started_at' => $same]);
    $a->forceFill(['submitted_at' => $same, 'score' => 5, 'max_score' => 10, 'graded_at' => $same])->save();

    $b = Attempt::create(['test_id' => $test->id, 'student_id' => $student->id, 'started_at' => $same]);
    $b->forceFill(['submitted_at' => $same, 'score' => 5, 'max_score' => 10, 'graded_at' => $same])->save();

    $result = AttemptPayload::latestAndBest(collect([$a, $b]));

    expect($result['best']['id'])->toBe($b->id);
});
