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

test('grade() is idempotent and never overwrites a manual grade on a second call', function () {
    $author = aTeacher();
    $test = aTestWithQuestions($author, 0);
    $sa = Question::factory()->for($test)->shortAnswer()->create(['position' => 0, 'points' => 2]);
    $student = aStudent();
    $attempt = Attempt::create(['test_id' => $test->id, 'student_id' => $student->id, 'started_at' => now()]);
    $attempt->answers()->create(['question_id' => $sa->id, 'response' => 'photosynthesis']);

    (new AttemptGrader)->grade($attempt);
    $attempt->refresh();

    $saRow = $attempt->answers->firstWhere('question_id', $sa->id);
    $saRow->forceFill(['awarded' => 1.5, 'graded_by' => $author->id])->save();
    (new AttemptGrader)->recompute($attempt);
    $attempt->refresh();
    expect((float) $attempt->score)->toBe(1.5)
        ->and($attempt->graded_at)->not->toBeNull();

    (new AttemptGrader)->grade($attempt);
    $attempt->refresh();

    $saRow->refresh();
    expect((float) $saRow->awarded)->toBe(1.5)
        ->and((float) $attempt->score)->toBe(1.5)
        ->and($attempt->graded_at)->not->toBeNull()
        ->and($attempt->answers)->toHaveCount(1);
});

test('fill_blank matches any accepted answer after normalization, or nothing when auto_grade is off', function () {
    $fb = q('fillBlank', ['Hydrogen bond', 'H-bond']); // points 4
    expect(AttemptGrader::score($fb, 'hydrogen bond'))->toBe(4.0)
        ->and(AttemptGrader::score($fb, '  Hydrogen   BOND. '))->toBe(4.0)
        ->and(AttemptGrader::score($fb, 'h-bond'))->toBe(4.0)
        ->and(AttemptGrader::score($fb, 'hydrogen bonds'))->toBe(0.0)
        ->and(AttemptGrader::score($fb, ''))->toBe(0.0)
        ->and(AttemptGrader::score($fb, null))->toBe(0.0)
        ->and(AttemptGrader::score($fb, ['hydrogen bond']))->toBe(0.0)
        ->and(AttemptGrader::score($fb, 42))->toBe(0.0);

    $manual = q('fillBlank', ['polar'], false);
    expect(AttemptGrader::score($manual, 'polar'))->toBeNull();
});

test('long answer is never auto-graded', function () {
    $la = q('longAnswer');
    expect(AttemptGrader::score($la, 'A paragraph.'))->toBeNull()
        ->and(AttemptGrader::score($la, null))->toBeNull();
});

test('every question type is either auto-graded or hand-gradable, never silently neither', function () {
    // AttemptGrader::score is the one place that decides which types wait
    // for a teacher (a null score). A null score on a type the teacher
    // cannot grade would leave every attempt on it ungraded for ever, so
    // bind the two together over every case -- plus fill_blank with
    // auto_grade off, the one per-item switch. A wrong-shaped response on
    // an auto-graded type scores 0, never an exception (decision 9).
    $cases = [];
    foreach (\App\Enums\QuestionType::cases() as $type) {
        $state = match ($type) {
            \App\Enums\QuestionType::MultipleChoice => ['multipleChoice'],
            \App\Enums\QuestionType::MultiSelect => ['multiSelect'],
            \App\Enums\QuestionType::TrueFalse => ['trueFalse'],
            \App\Enums\QuestionType::ShortAnswer => ['shortAnswer'],
            \App\Enums\QuestionType::Numeric => ['numeric'],
            \App\Enums\QuestionType::FillBlank => ['fillBlank'],
            \App\Enums\QuestionType::LongAnswer => ['longAnswer'],
        };
        $cases[$type->value] = [$type, q(...$state)];
    }
    $cases['fill_blank (auto_grade off)'] = [\App\Enums\QuestionType::FillBlank, q('fillBlank', ['polar'], false)];

    foreach ($cases as $label => [$type, $question]) {
        $score = AttemptGrader::score($question, ['nonsense']);
        if ($score === null) {
            expect($type->allowsManualGrade())->toBeTrue("{$label} scores null but cannot be hand-graded");
            expect($type->hasOptions())->toBeFalse("{$label} has options yet is never auto-scored");
        } else {
            expect($score)->toBe(0.0, $label);
        }
    }
});

test('blank normalization strips one trailing full stop and the whitespace around it, no more', function () {
    expect(AttemptGrader::normalizeBlank('polar .'))->toBe('polar')
        ->and(AttemptGrader::normalizeBlank('  Polar.  '))->toBe('polar')
        ->and(AttemptGrader::normalizeBlank("hydrogen \t  bond."))->toBe('hydrogen bond')
        ->and(AttemptGrader::normalizeBlank('polar...'))->toBe('polar..');

    $fb = q('fillBlank', ['polar']);
    expect(AttemptGrader::score($fb, 'polar .'))->toBe(4.0)
        ->and(AttemptGrader::score($fb, 'polar...'))->toBe(0.0);
});
