<?php

use App\Enums\QuestionType;
use App\Support\QuestionRules;
use App\Support\TestDraftValidator;
use Database\Seeders\ApBiology\Course;

/**
 * The content lint for database/seeders/data/ap-biology. Every rule here is
 * one the seeder's validator does NOT enforce: provenance, rationale
 * quality, spiral review, duplicates, attribution.
 */
function apBioCourse(): Course
{
    return new Course(Course::defaultDir());
}

/** Every test in the course: quizzes, unit exams, the practice exam. @return list<array{file: string, label: string, week: int|null, questions: list<array<string, mixed>>}> */
function apBioTests(Course $course): array
{
    $out = [];
    foreach ($course->weeks() as $week => ['file' => $file, 'data' => $data]) {
        if (isset($data['quiz'])) {
            $out[] = ['file' => $file, 'label' => "week {$week} quiz", 'week' => $week, 'questions' => array_values((array) $data['quiz']['questions'])];
        }
    }
    foreach ($course->unitExams() as $unit => ['file' => $file, 'data' => $data]) {
        $out[] = ['file' => $file, 'label' => "unit {$unit} exam", 'week' => null, 'questions' => array_values((array) $data['questions'])];
    }
    if ($exam = $course->practiceExam()) {
        $out[] = ['file' => $exam['file'], 'label' => 'practice exam', 'week' => null, 'questions' => array_values((array) $exam['data']['questions'])];
    }

    return $out;
}

test('course.yaml names eight units with the CED topic codes and the two accounts', function () {
    $course = apBioCourse();
    expect(count($course->config['units']))->toBe(8)
        ->and(array_keys($course->topics()))->toContain('1.1', '2.10', '3.5', '4.6', '5.5', '6.8', '7.12', '8.7')
        ->and($course->config['teacher']['email'])->toBe('apbio@example.com')
        ->and($course->config['student']['email'])->toBe('apbio-student@example.com');
});

test('every week file has a guide, 25-40 cards and a 20-25 question quiz; every week present is contiguous from week 1', function () {
    $course = apBioCourse();
    $weeks = $course->weeks();
    expect($weeks)->not->toBeEmpty('no week files yet');
    expect(array_keys($weeks))->toBe(range(1, count($weeks)));

    foreach ($weeks as $week => ['file' => $file, 'data' => $data]) {
        expect($data)->toHaveKeys(['title', 'topics', 'guide', 'flashcards', 'quiz'], "{$file}");
        expect(is_file("{$course->dir}/{$data['guide']}"))->toBeTrue("{$file}: guide {$data['guide']} is missing");
        $cards = count((array) $data['flashcards']);
        expect($cards)->toBeGreaterThanOrEqual(25, "{$file}: {$cards} cards")->toBeLessThanOrEqual(40, "{$file}: {$cards} cards");
        $n = count((array) $data['quiz']['questions']);
        expect($n)->toBeGreaterThanOrEqual(20, "{$file}: {$n} questions")->toBeLessThanOrEqual(25, "{$file}: {$n} questions");
        expect($course->unitForWeek($week))->not->toBeNull("{$file}: week {$week} is not in any unit");
        foreach ((array) $data['topics'] as $code) {
            expect(array_key_exists((string) $code, $course->topics()))->toBeTrue("{$file}: topic {$code} is not in course.yaml");
        }
    }
});

test('every item parses, has provenance, a valid shape and the required rationales', function () {
    $course = apBioCourse();
    $topics = $course->topics();
    $slugs = [];
    $prompts = [];

    foreach (apBioTests($course) as ['file' => $file, 'label' => $label, 'questions' => $questions]) {
        expect(count($questions))->toBeLessThanOrEqual(100, "{$label} has more than 100 questions");
        $bodies = [];
        foreach ($questions as $i => $raw) {
            $shaped = Course::shapeQuestion((array) $raw, $file, $i + 1);
            $q = $shaped['question'];
            $where = basename(dirname($file)).'/'.basename($file).' #'.($i + 1)." ({$shaped['slug']})";

            expect($shaped['slug'])->toMatch('/^[a-z0-9-]+$/', "{$where}: slug");
            expect($slugs)->not->toContain($shaped['slug'], "{$where}: duplicate slug");
            $slugs[] = $shaped['slug'];
            expect($shaped['source'])->not->toBe('', "{$where}: source");
            expect(array_key_exists($shaped['topic_code'], $topics))->toBeTrue("{$where}: topic_code {$shaped['topic_code']} is not in course.yaml");

            $key = mb_strtolower(preg_replace('/\s+/', ' ', trim($q['prompt'])));
            expect($prompts)->not->toContain($key, "{$where}: duplicate prompt");
            $prompts[] = $key;

            expect(QuestionRules::shapeError($q))->toBeNull("{$where}: ".(QuestionRules::shapeError($q) ?? ''));

            $type = QuestionType::from($q['type']);
            if ($type->hasOptions()) {
                expect(isset($q['option_explanations']))->toBeTrue("{$where}: option_explanations missing");
                expect(count($q['option_explanations']))->toBe(count($q['options']), "{$where}: one rationale per option");
                foreach ($q['option_explanations'] as $k => $r) {
                    $r = trim((string) $r);
                    expect(mb_strlen($r))->toBeGreaterThanOrEqual(40, "{$where}: rationale {$k} is under 40 chars");
                    expect(preg_match('/^(correct|incorrect)\.?$/i', $r))->toBe(0, "{$where}: rationale {$k} is boilerplate");
                }
                expect(preg_match('/\b(all|none) of the above\b/i', implode(' ', $q['options'])))->toBe(0, "{$where}: all/none of the above");
            }
            if (in_array($type, [QuestionType::FillBlank, QuestionType::ShortAnswer, QuestionType::LongAnswer, QuestionType::TrueFalse, QuestionType::Numeric], true)) {
                expect(trim((string) ($q['explanation'] ?? '')))->not->toBe('', "{$where}: explanation missing");
            }
            if ($type === QuestionType::MultiSelect) {
                expect($q['partial_credit'] ?? false)->toBeTrue("{$where}: multi_select without partial_credit");
            }
            $bodies[] = $q;
        }

        // The whole body, through the same validator the seeder uses.
        TestDraftValidator::validate([
            'title' => $label, 'subject' => 'science', 'grade_level' => '9-12', 'questions' => $bodies,
        ]);
    }
});

test('from week 2 on, at least a quarter of each quiz is spiral review from an earlier week', function () {
    $course = apBioCourse();
    $firstWeek = $course->topicFirstWeek();
    expect($firstWeek)->not->toBeEmpty();

    foreach ($course->weeks() as $week => ['file' => $file, 'data' => $data]) {
        if ($week < 2) {
            continue;
        }
        $questions = array_values((array) $data['quiz']['questions']);
        $review = 0;
        foreach ($questions as $q) {
            $code = (string) $q['topic_code'];
            if (($firstWeek[$code] ?? $week) < $week) {
                $review++;
            }
        }
        $share = $review / max(1, count($questions));
        expect($share)->toBeGreaterThanOrEqual(0.25, sprintf('%s: %d of %d items (%.0f%%) are spiral review', basename($file), $review, count($questions), $share * 100));
    }
});

test('every quiz mixes the item types the course calls for', function () {
    $course = apBioCourse();
    foreach ($course->weeks() as $week => ['file' => $file, 'data' => $data]) {
        $types = array_count_values(array_map(fn ($q) => $q['type'], array_values((array) $data['quiz']['questions'])));
        $where = basename($file);
        expect($types['multiple_choice'] ?? 0)->toBeGreaterThanOrEqual(10, "{$where}: multiple_choice");
        expect($types['multi_select'] ?? 0)->toBeGreaterThanOrEqual(2, "{$where}: multi_select");
        expect($types['true_false'] ?? 0)->toBeGreaterThanOrEqual(2, "{$where}: true_false");
        expect($types['fill_blank'] ?? 0)->toBeGreaterThanOrEqual(2, "{$where}: fill_blank");
        expect($types['short_answer'] ?? 0)->toBeGreaterThanOrEqual(2, "{$where}: short_answer");
        expect($types['long_answer'] ?? 0)->toBeGreaterThanOrEqual(1, "{$where}: long_answer");
    }
});

test('from week 4 on every quiz has a stimulus set of at least three consecutive items', function () {
    $course = apBioCourse();
    expect($course->weeks())->not->toBeEmpty();
    foreach ($course->weeks() as $week => ['file' => $file, 'data' => $data]) {
        if ($week < 4) {
            continue;
        }
        $run = 0;
        $best = 0;
        $previous = null;
        foreach (array_values((array) $data['quiz']['questions']) as $q) {
            $s = trim((string) ($q['stimulus'] ?? ''));
            $run = ($s !== '' && $s === $previous) ? $run + 1 : ($s !== '' ? 1 : 0);
            $best = max($best, $run);
            $previous = $s;
        }
        expect($best)->toBeGreaterThanOrEqual(3, basename($file).": longest stimulus set is {$best}");
    }
});

test('unit exams carry 40-50 items with two stimulus sets and two free-response items', function () {
    $course = apBioCourse();
    expect($course->unitExams())->toBeArray();
    foreach ($course->unitExams() as $unit => ['file' => $file, 'data' => $data]) {
        $questions = array_values((array) $data['questions']);
        $n = count($questions);
        expect($n)->toBeGreaterThanOrEqual(40, "unit {$unit} exam: {$n}")->toBeLessThanOrEqual(50, "unit {$unit} exam: {$n}");
        $types = array_count_values(array_map(fn ($q) => $q['type'], $questions));
        expect($types['short_answer'] ?? 0)->toBeGreaterThanOrEqual(1)->and($types['long_answer'] ?? 0)->toBeGreaterThanOrEqual(1);

        $sets = 0;
        $previous = null;
        $run = 0;
        foreach ($questions as $q) {
            $s = trim((string) ($q['stimulus'] ?? ''));
            if ($s !== '' && $s === $previous) {
                $run++;
                if ($run === 3) {
                    $sets++;
                }
            } else {
                $run = $s !== '' ? 1 : 0;
            }
            $previous = $s;
        }
        expect($sets)->toBeGreaterThanOrEqual(2, "unit {$unit} exam: {$sets} stimulus sets of three");
    }
});

test('every guide and summary ends with the CC BY attribution block, and ATTRIBUTION.md exists', function () {
    $course = apBioCourse();
    $files = [];
    foreach ($course->weeks() as ['data' => $data]) {
        $files[] = "{$course->dir}/{$data['guide']}";
    }
    $files = [...$files, ...array_values($course->unitSummaries())];
    if ($guide = $course->examPrepGuide()) {
        $files[] = $guide;
    }
    foreach ($files as $file) {
        expect(Course::endsWithAttribution(file_get_contents($file)))->toBeTrue(basename($file).' lacks the attribution block');
        $words = str_word_count(strip_tags(file_get_contents($file)));
        expect($words)->toBeGreaterThanOrEqual(600, basename($file)." is only {$words} words");
    }
    expect(is_file("{$course->dir}/ATTRIBUTION.md"))->toBeTrue();
});

test('no card repeats an earlier week\'s front', function () {
    $course = apBioCourse();
    $seen = [];
    foreach ($course->weeks() as $week => ['file' => $file, 'data' => $data]) {
        foreach ((array) $data['flashcards'] as $i => $card) {
            $front = mb_strtolower(trim((string) $card['front']));
            expect(array_key_exists($front, $seen))->toBeFalse(basename($file).' card #'.($i + 1).' repeats week '.($seen[$front] ?? '?')."'s '{$front}'");
            $seen[$front] = $week;
            expect(trim((string) $card['back']))->not->toBe('', basename($file).' card #'.($i + 1).' has no back');
        }
    }
});
