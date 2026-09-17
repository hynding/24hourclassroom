<?php

use App\Models\Answer;
use App\Models\Attempt;
use App\Models\Question;
use App\Services\AttemptGrader;

function q(string $state = 'multipleChoice', mixed ...$args): Question
{
    $test = aTestWithQuestions(aTeacher(), 0);
    $factory = Question::factory()->for($test);
    if ($state !== 'multipleChoice') {
        $factory = $factory->{$state}(...$args);
    }

    return $factory->create(['points' => 4]);
}

test('multiple choice and true/false are exact-match, strict on type', function () {
    $mc = q(); // answer 0, points 4
    expect(AttemptGrader::score($mc, 0))->toBe(4.0)
        ->and(AttemptGrader::score($mc, 1))->toBe(0.0)
        ->and(AttemptGrader::score($mc, '0'))->toBe(0.0)
        ->and(AttemptGrader::score($mc, null))->toBe(0.0)
        ->and(AttemptGrader::score($mc, [0]))->toBe(0.0);

    $tf = q('trueFalse'); // answer true
    expect(AttemptGrader::score($tf, true))->toBe(4.0)
        ->and(AttemptGrader::score($tf, false))->toBe(0.0)
        ->and(AttemptGrader::score($tf, 'true'))->toBe(0.0)
        ->and(AttemptGrader::score($tf, 1))->toBe(0.0);
});

test('multi-select all-or-nothing', function () {
    $ms = q('multiSelect'); // answer [0, 2]
    expect(AttemptGrader::score($ms, [0, 2]))->toBe(4.0)
        ->and(AttemptGrader::score($ms, [2, 0]))->toBe(4.0)
        ->and(AttemptGrader::score($ms, [0]))->toBe(0.0)
        ->and(AttemptGrader::score($ms, [0, 1, 2]))->toBe(0.0)
        ->and(AttemptGrader::score($ms, 0))->toBe(0.0)
        ->and(AttemptGrader::score($ms, ['0', '2']))->toBe(0.0)
        ->and(AttemptGrader::score($ms, []))->toBe(0.0);
});

test('multi-select partial credit: (right - wrong) / correct, floored at zero', function () {
    $ms = q('multiSelect', true); // answer [0, 2], 4 points
    expect(AttemptGrader::score($ms, [0, 2]))->toBe(4.0)
        ->and(AttemptGrader::score($ms, [0]))->toBe(2.0)          // 1/2
        ->and(AttemptGrader::score($ms, [0, 1]))->toBe(0.0)       // (1-1)/2
        ->and(AttemptGrader::score($ms, [1, 3]))->toBe(0.0)       // negative -> 0
        ->and(AttemptGrader::score($ms, [0, 2, 1]))->toBe(2.0)    // (2-1)/2
        ->and(AttemptGrader::score($ms, [0, 0, 2]))->toBe(4.0);   // duplicates collapse
});

test('numeric matches within tolerance and accepts numeric strings', function () {
    $exact = q('numeric', 42, 0);
    expect(AttemptGrader::score($exact, 42))->toBe(4.0)
        ->and(AttemptGrader::score($exact, 42.0))->toBe(4.0)
        ->and(AttemptGrader::score($exact, '42'))->toBe(4.0)
        ->and(AttemptGrader::score($exact, 41.9))->toBe(0.0)
        ->and(AttemptGrader::score($exact, 'forty-two'))->toBe(0.0)
        ->and(AttemptGrader::score($exact, null))->toBe(0.0)
        ->and(AttemptGrader::score($exact, [42]))->toBe(0.0);

    $loose = q('numeric', 10, 0.5);
    expect(AttemptGrader::score($loose, 10.5))->toBe(4.0)
        ->and(AttemptGrader::score($loose, 9.5))->toBe(4.0)
        ->and(AttemptGrader::score($loose, 10.51))->toBe(0.0);
});

test('short answer is never auto-graded', function () {
    $sa = q('shortAnswer');
    expect(AttemptGrader::score($sa, 'photosynthesis'))->toBeNull()
        ->and(AttemptGrader::score($sa, null))->toBeNull();
});

test('grade() snapshots, creates missing rows, drops trashed-question rows, and sets graded_at only when nothing is ungraded', function () {
    $author = aTeacher();
    $test = aTestWithQuestions($author, 0);
    $mc = Question::factory()->for($test)->create(['position' => 0, 'points' => 3]); // answer 0
    $sa = Question::factory()->for($test)->shortAnswer()->create(['position' => 1, 'points' => 2]);
    $trashed = Question::factory()->for($test)->create(['position' => 2]);
    $student = aStudent();
    $attempt = Attempt::create(['test_id' => $test->id, 'student_id' => $student->id, 'started_at' => now()]);
    $attempt->answers()->create(['question_id' => $mc->id, 'response' => 0]);
    $attempt->answers()->create(['question_id' => $trashed->id, 'response' => 1]);
    $trashed->delete();

    (new AttemptGrader)->grade($attempt);
    $attempt->refresh();

    expect((float) $attempt->score)->toBe(3.0)
        ->and((float) $attempt->max_score)->toBe(5.0)
        ->and($attempt->graded_at)->toBeNull()
        ->and($attempt->answers)->toHaveCount(2)
        ->and(Answer::where('question_id', $trashed->id)->exists())->toBeFalse();

    $saRow = $attempt->answers->firstWhere('question_id', $sa->id);
    expect($saRow->response)->toBeNull()
        ->and($saRow->awarded)->toBeNull()
        ->and($saRow->graded_answer)->toBe(['answer' => 'photosynthesis', 'points' => 2]);

    $mcRow = $attempt->answers->firstWhere('question_id', $mc->id);
    expect((float) $mcRow->awarded)->toBe(3.0)
        ->and($mcRow->graded_answer)->toBe(['answer' => 0, 'points' => 3]);

    $saRow->forceFill(['awarded' => 1.5, 'graded_by' => $author->id])->save();
    (new AttemptGrader)->recompute($attempt);
    $attempt->refresh();
    expect((float) $attempt->score)->toBe(4.5)
        ->and($attempt->graded_at)->not->toBeNull()
        ->and(AttemptGrader::ungradedCount($attempt))->toBe(0);
});
