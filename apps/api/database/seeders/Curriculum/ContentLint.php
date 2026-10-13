<?php

namespace Database\Seeders\Curriculum;

use App\Enums\QuestionType;
use App\Support\QuestionRules;
use App\Support\TestDraftValidator;
use Illuminate\Validation\ValidationException;
use RuntimeException;

/**
 * The content lint for a seeded course. Every rule here is one the seeder's
 * validator does NOT enforce: provenance, rationale quality, spiral review,
 * duplicates, attribution. Each rule returns its failures as readable lines
 * (empty = clean) so the Pest suite and an author checking a draft unit see
 * the same messages.
 */
final class ContentLint
{
    public function __construct(private readonly Course $course) {}

    /** Every rule, keyed by name. @return array<string, list<string>> */
    public function all(): array
    {
        $out = [];
        foreach (self::RULES as $rule) {
            $out[$rule] = $this->{$rule}();
        }

        return $out;
    }

    public const RULES = ['weeks', 'items', 'spiralReview', 'typeMix', 'stimulusSets', 'unitExams', 'attribution', 'flashcards'];

    /** Every test in the course: quizzes, unit exams, the practice exam. @return list<array{file: string, label: string, questions: list<array<string, mixed>>}> */
    public function tests(): array
    {
        $out = [];
        foreach ($this->course->weeks() as $week => ['file' => $file, 'data' => $data]) {
            if (isset($data['quiz'])) {
                $out[] = ['file' => $file, 'label' => "week {$week} quiz", 'questions' => array_values((array) ($data['quiz']['questions'] ?? []))];
            }
        }
        foreach ($this->course->unitExams() as $unit => ['file' => $file, 'data' => $data]) {
            $out[] = ['file' => $file, 'label' => "unit {$unit} exam", 'questions' => array_values((array) ($data['questions'] ?? []))];
        }
        if ($exam = $this->course->practiceExam()) {
            $out[] = ['file' => $exam['file'], 'label' => 'practice exam', 'questions' => array_values((array) ($exam['data']['questions'] ?? []))];
        }

        return $out;
    }

    /** Every week file has a guide, 25-40 cards and a 20-25 question quiz; weeks are contiguous from week 1. @return list<string> */
    public function weeks(): array
    {
        $c = $this->course;
        $weeks = $c->weeks();
        $errors = [];
        if ($weeks === []) {
            return ['no week files yet'];
        }
        if (array_keys($weeks) !== range(1, count($weeks))) {
            $errors[] = 'weeks are not contiguous from week 1: '.implode(', ', array_keys($weeks));
        }

        foreach ($weeks as $week => ['file' => $file, 'data' => $data]) {
            $where = $this->where($file);
            foreach (['title', 'topics', 'guide', 'flashcards', 'quiz'] as $key) {
                if (! array_key_exists($key, $data)) {
                    $errors[] = "{$where}: missing `{$key}`";
                }
            }
            if (isset($data['guide']) && ! is_file("{$c->dir}/{$data['guide']}")) {
                $errors[] = "{$where}: guide {$data['guide']} is missing";
            }
            $cards = count((array) ($data['flashcards'] ?? []));
            if ($cards < 25 || $cards > 40) {
                $errors[] = "{$where}: {$cards} cards (want 25-40)";
            }
            $n = count((array) ($data['quiz']['questions'] ?? []));
            if ($n < 20 || $n > 25) {
                $errors[] = "{$where}: {$n} quiz questions (want 20-25)";
            }
            if ($c->unitForWeek($week) === null) {
                $errors[] = "{$where}: week {$week} is not in any unit";
            }
            foreach ((array) ($data['topics'] ?? []) as $code) {
                if (! array_key_exists((string) $code, $c->topics())) {
                    $errors[] = "{$where}: topic {$code} is not in course.yaml";
                }
            }
        }

        return $errors;
    }

    /** Every item parses, has provenance, a valid shape and the required rationales; no duplicate slugs or prompts. @return list<string> */
    public function items(): array
    {
        $topics = $this->course->topics();
        $slugs = [];
        $prompts = [];
        $errors = [];

        foreach ($this->tests() as ['file' => $file, 'label' => $label, 'questions' => $questions]) {
            if (count($questions) > 100) {
                $errors[] = "{$label} has more than 100 questions";
            }
            $bodies = [];
            foreach ($questions as $i => $raw) {
                $at = $this->where($file).' #'.($i + 1);
                try {
                    $shaped = Course::shapeQuestion((array) $raw, $file, $i + 1);
                } catch (RuntimeException $e) {
                    $errors[] = $e->getMessage();

                    continue;
                }
                $q = $shaped['question'];
                $where = "{$at} ({$shaped['slug']})";

                if (! preg_match('/^[a-z0-9-]+$/', $shaped['slug'])) {
                    $errors[] = "{$where}: slug must be lowercase letters, digits and hyphens";
                }
                if (isset($slugs[$shaped['slug']])) {
                    $errors[] = "{$where}: duplicate slug (also {$slugs[$shaped['slug']]})";
                }
                $slugs[$shaped['slug']] = $at;
                if (trim($shaped['source']) === '') {
                    $errors[] = "{$where}: empty source";
                }
                if (! array_key_exists($shaped['topic_code'], $topics)) {
                    $errors[] = "{$where}: topic_code {$shaped['topic_code']} is not in course.yaml";
                }

                // A stem like "Which conclusion is best supported by the data?"
                // legitimately recurs under different stimuli; the pair must not.
                $key = mb_strtolower(preg_replace('/\s+/', ' ', trim(($q['stimulus'] ?? '')."\n".$q['prompt'])));
                if (isset($prompts[$key])) {
                    $errors[] = "{$where}: duplicate prompt (also {$prompts[$key]})";
                }
                $prompts[$key] = $at;

                if ($shape = QuestionRules::shapeError($q)) {
                    $errors[] = "{$where}: {$shape}";

                    continue;
                }

                $type = QuestionType::from($q['type']);
                if ($type->hasOptions()) {
                    if (! isset($q['option_explanations'])) {
                        $errors[] = "{$where}: option_explanations missing";
                    } elseif (count($q['option_explanations']) !== count($q['options'])) {
                        $errors[] = "{$where}: one rationale per option";
                    } else {
                        foreach ($q['option_explanations'] as $k => $r) {
                            $r = trim((string) $r);
                            if (mb_strlen($r) < 40) {
                                $errors[] = "{$where}: rationale {$k} is under 40 chars";
                            }
                            if (preg_match('/^(correct|incorrect)\.?$/i', $r)) {
                                $errors[] = "{$where}: rationale {$k} is boilerplate";
                            }
                        }
                    }
                    if (preg_match('/\b(all|none) of the above\b/i', implode(' ', $q['options']))) {
                        $errors[] = "{$where}: all/none of the above";
                    }
                }
                if (in_array($type, [QuestionType::FillBlank, QuestionType::ShortAnswer, QuestionType::LongAnswer, QuestionType::TrueFalse, QuestionType::Numeric], true)
                    && trim((string) ($q['explanation'] ?? '')) === '') {
                    $errors[] = "{$where}: explanation missing";
                }
                if ($type === QuestionType::MultiSelect && ! ($q['partial_credit'] ?? false)) {
                    $errors[] = "{$where}: multi_select without partial_credit";
                }
                $bodies[] = $q;
            }

            // The whole body, through the same validator the seeder uses.
            try {
                TestDraftValidator::validate([
                    'title' => $label,
                    'subject' => $this->course->config['subject'],
                    'grade_level' => $this->course->config['grade_level'],
                    'questions' => $bodies,
                ]);
            } catch (ValidationException $e) {
                foreach ($e->errors() as $field => $messages) {
                    $errors[] = $this->where($file).": {$field}: ".implode(' ', $messages);
                }
            }
        }

        return $errors;
    }

    /** From week 2 on, at least a quarter of each quiz is spiral review from an earlier week. @return list<string> */
    public function spiralReview(): array
    {
        $firstWeek = $this->course->topicFirstWeek();
        $errors = [];
        foreach ($this->course->weeks() as $week => ['file' => $file, 'data' => $data]) {
            if ($week < 2) {
                continue;
            }
            $questions = array_values((array) ($data['quiz']['questions'] ?? []));
            $review = 0;
            foreach ($questions as $q) {
                if (($firstWeek[(string) ($q['topic_code'] ?? '')] ?? $week) < $week) {
                    $review++;
                }
            }
            $share = $review / max(1, count($questions));
            if ($share < 0.25) {
                $errors[] = sprintf('%s: %d of %d items (%.0f%%) are spiral review (want 25%%+)', $this->where($file), $review, count($questions), $share * 100);
            }
        }

        return $errors;
    }

    /** Every quiz mixes the item types the course calls for. @return list<string> */
    public function typeMix(): array
    {
        $want = ['multiple_choice' => 10, 'multi_select' => 2, 'true_false' => 2, 'fill_blank' => 2, 'short_answer' => 2, 'long_answer' => 1];
        $errors = [];
        foreach ($this->course->weeks() as ['file' => $file, 'data' => $data]) {
            $types = array_count_values(array_map(fn ($q) => (string) ($q['type'] ?? ''), array_values((array) ($data['quiz']['questions'] ?? []))));
            foreach ($want as $type => $min) {
                if (($types[$type] ?? 0) < $min) {
                    $errors[] = sprintf('%s: %d %s (want %d+)', $this->where($file), $types[$type] ?? 0, $type, $min);
                }
            }
        }

        return $errors;
    }

    /** From week 4 on every quiz has a stimulus set of at least three consecutive items. @return list<string> */
    public function stimulusSets(): array
    {
        $errors = [];
        foreach ($this->course->weeks() as $week => ['file' => $file, 'data' => $data]) {
            if ($week < 4) {
                continue;
            }
            $best = $this->longestStimulusRun(array_values((array) ($data['quiz']['questions'] ?? [])));
            if ($best < 3) {
                $errors[] = $this->where($file).": longest stimulus set is {$best} (want 3+)";
            }
        }

        return $errors;
    }

    /** Unit exams carry 40-50 items with two stimulus sets of three and both kinds of free response. @return list<string> */
    public function unitExams(): array
    {
        $errors = [];
        foreach ($this->course->unitExams() as $unit => ['file' => $file, 'data' => $data]) {
            $questions = array_values((array) ($data['questions'] ?? []));
            $n = count($questions);
            if ($n < 40 || $n > 50) {
                $errors[] = "unit {$unit} exam: {$n} items (want 40-50)";
            }
            $types = array_count_values(array_map(fn ($q) => (string) ($q['type'] ?? ''), $questions));
            if (($types['short_answer'] ?? 0) < 1 || ($types['long_answer'] ?? 0) < 1) {
                $errors[] = "unit {$unit} exam: needs a short_answer and a long_answer";
            }

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
            if ($sets < 2) {
                $errors[] = "unit {$unit} exam: {$sets} stimulus sets of three (want 2+)";
            }
        }

        return $errors;
    }

    /** Every guide and summary is 600+ words and ends with the attribution block; ATTRIBUTION.md exists. @return list<string> */
    public function attribution(): array
    {
        $c = $this->course;
        $files = [];
        foreach ($c->weeks() as ['data' => $data]) {
            if (isset($data['guide'])) {
                $files[] = "{$c->dir}/{$data['guide']}";
            }
        }
        $files = [...$files, ...array_values($c->unitSummaries())];
        if ($guide = $c->examPrepGuide()) {
            $files[] = $guide;
        }

        $errors = [];
        foreach ($files as $file) {
            if (! is_file($file)) {
                continue; // weeks() reports a missing guide
            }
            $body = (string) file_get_contents($file);
            if (! $c->endsWithAttribution($body)) {
                $errors[] = basename($file).' lacks the attribution block ('.implode(' + ', $c->attributionMarkers()).' in its last 1,200 characters)';
            }
            $words = str_word_count(strip_tags($body));
            if ($words < 600) {
                $errors[] = basename($file)." is only {$words} words (want 600+)";
            }
        }
        if (! is_file("{$c->dir}/ATTRIBUTION.md")) {
            $errors[] = 'ATTRIBUTION.md is missing';
        }

        return $errors;
    }

    /** No card repeats an earlier front; every card has a back. @return list<string> */
    public function flashcards(): array
    {
        $seen = [];
        $errors = [];
        foreach ($this->course->weeks() as $week => ['file' => $file, 'data' => $data]) {
            foreach ((array) ($data['flashcards'] ?? []) as $i => $card) {
                $front = mb_strtolower(trim((string) ($card['front'] ?? '')));
                $where = $this->where($file).' card #'.($i + 1);
                if (isset($seen[$front])) {
                    $errors[] = "{$where} repeats week {$seen[$front]}'s '{$front}'";
                }
                $seen[$front] = $week;
                if (trim((string) ($card['back'] ?? '')) === '') {
                    $errors[] = "{$where} has no back";
                }
            }
        }

        return $errors;
    }

    /** @param list<array<string, mixed>> $questions */
    private function longestStimulusRun(array $questions): int
    {
        $run = 0;
        $best = 0;
        $previous = null;
        foreach ($questions as $q) {
            $s = trim((string) ($q['stimulus'] ?? ''));
            $run = ($s !== '' && $s === $previous) ? $run + 1 : ($s !== '' ? 1 : 0);
            $best = max($best, $run);
            $previous = $s;
        }

        return $best;
    }

    private function where(string $file): string
    {
        return basename(dirname($file)).'/'.basename($file);
    }
}
