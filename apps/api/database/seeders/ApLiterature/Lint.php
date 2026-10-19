<?php

namespace Database\Seeders\ApLiterature;

use App\Enums\QuestionType;
use App\Support\QuestionRules;
use App\Support\TestDraftValidator;
use Database\Seeders\Curriculum\ContentLint;
use Illuminate\Validation\ValidationException;
use RuntimeException;

/**
 * The content lint for the AP Literature data directory: every rule the
 * seeder's validator does NOT enforce -- provenance and the public-domain
 * cutoff, rationale quality, spiral review, passage sets, the exam's shape,
 * duplicates, attribution. Returns problems as strings instead of failing on
 * the first, so ApLiteratureContentTest can print them all and an author can
 * lint one unit while the rest of the course is still being written.
 */
final class Lint
{
    /**
     * Works published in the United States in this year or earlier are in
     * the public domain there (as of 1 January 2026). Every quoted text must
     * be at least this old.
     */
    public const PUBLIC_DOMAIN_THROUGH = 1930;

    /** Where a week's `texts` may point: full public-domain texts or reputable reading editions. */
    public const TEXT_HOSTS = ['www.gutenberg.org', 'gutenberg.org', 'www.poetryfoundation.org', 'www.folger.edu', 'www.loc.gov', 'archive.org', 'en.wikisource.org', 'www.bartleby.com'];

    public const GUIDE_MIN_WORDS = 1200;

    public const SUMMARY_MIN_WORDS = 600;

    /** @var list<string> */
    private array $problems = [];

    /** Keys already seen across the files linted so far. @var array<string, string> */
    private array $slugs = [];

    /** @var array<string, string> */
    private array $prompts = [];

    /** @var array<string, string> */
    private array $fronts = [];

    public function __construct(private readonly Course $course) {}

    /**
     * Lint the whole course, or only some units (and then the course-wide
     * checks that need every week -- contiguity, the review files -- are
     * skipped).
     *
     * @param  list<int>|null  $units
     * @return list<string>
     */
    public function run(?array $units = null): array
    {
        $this->problems = [];
        $c = $this->course;

        $this->config();

        $weeks = $c->weeks();
        if ($units === null) {
            $expected = array_merge(...array_map(fn ($u) => (array) $u['weeks'], $c->config['units']));
            if (array_keys($weeks) !== $expected) {
                $this->fail('course', 'weeks present ['.implode(',', array_keys($weeks)).'] are not the course map\'s weeks ['.implode(',', $expected).']');
            }
        }

        foreach ($weeks as $week => ['file' => $file, 'data' => $data]) {
            $unit = $c->unitForWeek($week);
            if ($units !== null && ! in_array((int) ($unit['number'] ?? 0), $units, true)) {
                continue;
            }
            $this->week($week, $file, $data);
        }

        foreach ($c->unitExams() as $number => ['file' => $file, 'data' => $data]) {
            if ($units === null || in_array($number, $units, true)) {
                $this->unitExam($number, $file, $data);
            }
        }

        foreach ($c->config['units'] as $unit) {
            $n = (int) $unit['number'];
            if ($units !== null && ! in_array($n, $units, true)) {
                continue;
            }
            $summaries = $c->unitSummaries();
            if (! isset($summaries[$n])) {
                $this->fail("unit {$n}", 'unit-summary.md is missing');
            } else {
                $this->prose($summaries[$n], self::SUMMARY_MIN_WORDS);
            }
            if (! isset($c->unitExams()[$n])) {
                $this->fail("unit {$n}", 'unit-exam.yaml is missing');
            }
        }

        if ($units === null) {
            $exam = $c->practiceExam();
            $exam === null ? $this->fail('review', 'practice-exam.yaml is missing') : $this->practiceExam($exam['file'], $exam['data']);
            $guide = $c->examPrepGuide();
            $guide === null ? $this->fail('review', 'exam-prep-guide.md is missing') : $this->prose($guide, self::GUIDE_MIN_WORDS);
            if (! is_file("{$c->dir}/ATTRIBUTION.md")) {
                $this->fail('course', 'ATTRIBUTION.md is missing');
            }
            foreach (ContentLint::licence($c->dir, (string) ($c->config['description'] ?? '')) as $problem) {
                $this->fail('course', $problem);
            }
        }

        return $this->problems;
    }

    private function config(): void
    {
        $skills = $this->course->topics();
        foreach ($this->course->config['units'] as $unit) {
            foreach ((array) ($unit['skills'] ?? []) as $code) {
                if (! isset($skills[(string) $code])) {
                    $this->fail('course.yaml', "unit {$unit['number']} names skill {$code}, which is not under `skills`");
                }
            }
        }
    }

    /** @param  array<string, mixed>  $data */
    private function week(int $week, string $file, array $data): void
    {
        $where = $this->rel($file);
        foreach (['title', 'topics', 'texts', 'guide', 'flashcards', 'quiz'] as $key) {
            if (! isset($data[$key])) {
                $this->fail($where, "missing `{$key}`");

                return;
            }
        }
        $skills = $this->course->topics();
        if ($this->course->unitForWeek($week) === null) {
            $this->fail($where, "week {$week} is not in any unit");
        }
        if ((int) ($data['unit'] ?? 0) !== (int) ($this->course->unitForWeek($week)['number'] ?? -1)) {
            $this->fail($where, '`unit` does not match the course map');
        }
        if (! str_contains($file, '/'.($this->course->unitForWeek($week)['slug'] ?? '?').'/')) {
            $this->fail($where, 'is not in its unit\'s directory');
        }
        foreach ((array) $data['topics'] as $code) {
            if (! isset($skills[(string) $code])) {
                $this->fail($where, "topic {$code} is not a CED skill in course.yaml");
            }
        }

        $this->texts($where, (array) $data['texts']);

        $guide = "{$this->course->dir}/{$data['guide']}";
        is_file($guide) ? $this->prose($guide, self::GUIDE_MIN_WORDS) : $this->fail($where, "guide {$data['guide']} is missing");

        $cards = (array) $data['flashcards'];
        if (count($cards) < 25 || count($cards) > 40) {
            $this->fail($where, count($cards).' flashcards (want 25-40)');
        }
        foreach (array_values($cards) as $i => $card) {
            $front = mb_strtolower(trim((string) ($card['front'] ?? '')));
            $at = "{$where} card #".($i + 1);
            if ($front === '' || trim((string) ($card['back'] ?? '')) === '') {
                $this->fail($at, 'needs a front and a back');
            }
            if (isset($this->fronts[$front])) {
                $this->fail($at, "repeats the front '{$front}' of {$this->fronts[$front]}");
            }
            $this->fronts[$front] = $at;
            if (! isset($skills[(string) ($card['topic_code'] ?? '')])) {
                $this->fail($at, 'topic_code is not a CED skill');
            }
        }

        $questions = array_values((array) ($data['quiz']['questions'] ?? []));
        $n = count($questions);
        if ($n < 20 || $n > 25) {
            $this->fail($where, "{$n} quiz questions (want 20-25)");
        }
        $this->items($where, $questions);

        $types = array_count_values(array_map(fn ($q) => (string) ($q['type'] ?? ''), $questions));
        foreach (['multiple_choice' => 10, 'multi_select' => 2, 'true_false' => 2, 'fill_blank' => 2, 'short_answer' => 2, 'long_answer' => 1] as $type => $min) {
            if (($types[$type] ?? 0) < $min) {
                $this->fail($where, ($types[$type] ?? 0)." {$type} items (want at least {$min})");
            }
        }

        if ($this->longestSet($questions) < 3) {
            $this->fail($where, 'no passage set: want at least three consecutive items sharing one stimulus');
        }

        // Spiral review: from week 2, a quarter of the items exercise a skill
        // that an EARLIER week put in focus and this week does not.
        if ($week >= 2) {
            $first = $this->course->topicFirstWeek();
            $focus = array_map('strval', (array) $data['topics']);
            $review = count(array_filter($questions, function ($q) use ($first, $week, $focus) {
                $code = (string) ($q['topic_code'] ?? '');

                return ($first[$code] ?? $week) < $week && ! in_array($code, $focus, true);
            }));
            if ($review / max(1, $n) < 0.25) {
                $this->fail($where, "{$review} of {$n} items are spiral review (want at least 25%: a skill an earlier week focused on and this week does not)");
            }
        }
    }

    /** @param  array<string, mixed>  $data */
    private function unitExam(int $unit, string $file, array $data): void
    {
        $where = $this->rel($file);
        $questions = array_values((array) ($data['questions'] ?? []));
        $n = count($questions);
        if ($n < 40 || $n > 50) {
            $this->fail($where, "{$n} items (want 40-50)");
        }
        $this->items($where, $questions);
        $types = array_count_values(array_map(fn ($q) => (string) ($q['type'] ?? ''), $questions));
        if (($types['short_answer'] ?? 0) < 1 || ($types['long_answer'] ?? 0) < 1) {
            $this->fail($where, 'wants at least one short_answer and one long_answer');
        }
        if ($this->sets($questions, 3) < 3) {
            $this->fail($where, 'wants at least three passage sets of three or more items');
        }
    }

    /**
     * The exam's shape: Section I is 55 multiple-choice items in five passage
     * sets of 8-13; Section II is the three essays, each on the 6-point rubric.
     *
     * @param  array<string, mixed>  $data
     */
    private function practiceExam(string $file, array $data): void
    {
        $where = $this->rel($file);
        $questions = array_values((array) ($data['questions'] ?? []));
        $this->items($where, $questions);

        $mc = array_values(array_filter($questions, fn ($q) => ($q['type'] ?? '') === 'multiple_choice'));
        $essays = array_values(array_filter($questions, fn ($q) => ($q['type'] ?? '') === 'long_answer'));
        if (count($mc) !== 55 || count($essays) !== 3 || count($questions) !== 58) {
            $this->fail($where, sprintf('%d multiple choice and %d essays of %d items (want 55 + 3 = 58)', count($mc), count($essays), count($questions)));
        }
        $bySet = [];
        foreach ($mc as $q) {
            $s = trim((string) ($q['stimulus'] ?? ''));
            if ($s === '') {
                $this->fail($where, "{$q['slug']}: every Section I item reads a passage");
            }
            $bySet[$s] = ($bySet[$s] ?? 0) + 1;
        }
        if (count($bySet) !== 5) {
            $this->fail($where, count($bySet).' passages in Section I (want 5)');
        }
        foreach ($bySet as $count) {
            if ($count < 8 || $count > 13) {
                $this->fail($where, "a Section I set has {$count} items (want 8-13)");
            }
        }
        foreach ($essays as $q) {
            if ((int) ($q['points'] ?? 0) !== 6) {
                $this->fail($where, "{$q['slug']}: an essay is scored out of 6");
            }
        }
    }

    /** @param  list<array<string, mixed>>  $questions */
    private function items(string $where, array $questions): void
    {
        $skills = $this->course->topics();
        $bodies = [];
        foreach ($questions as $i => $raw) {
            try {
                $shaped = Course::shapeQuestion((array) $raw, $where, $i + 1);
            } catch (RuntimeException $e) {
                $this->fail($where, $e->getMessage());

                continue;
            }
            $q = $shaped['question'];
            $at = "{$where} #".($i + 1)." ({$shaped['slug']})";

            if (! preg_match('/^[a-z0-9-]+$/', $shaped['slug'])) {
                $this->fail($at, 'slug must be lowercase letters, digits and hyphens');
            }
            if (isset($this->slugs[$shaped['slug']])) {
                $this->fail($at, "duplicate slug (also {$this->slugs[$shaped['slug']]})");
            }
            $this->slugs[$shaped['slug']] = $at;

            if (! isset($skills[$shaped['topic_code']])) {
                $this->fail($at, "topic_code {$shaped['topic_code']} is not a CED skill");
            }
            $this->source($at, $shaped['source']);

            // The same question stem is fine on a different passage.
            $key = mb_strtolower(preg_replace('/\s+/', ' ', trim(($q['stimulus'] ?? '').' || '.$q['prompt'])));
            if (isset($this->prompts[$key])) {
                $this->fail($at, "duplicate prompt (also {$this->prompts[$key]})");
            }
            $this->prompts[$key] = $at;

            if ($error = QuestionRules::shapeError($q)) {
                $this->fail($at, $error);

                continue;
            }

            $type = QuestionType::from($q['type']);
            if ($type->hasOptions()) {
                $rationales = $q['option_explanations'] ?? null;
                if (! is_array($rationales) || count($rationales) !== count($q['options'])) {
                    $this->fail($at, 'wants one option_explanations entry per option');
                } else {
                    foreach ($rationales as $k => $r) {
                        $r = trim((string) $r);
                        if (mb_strlen($r) < 40 || preg_match('/^(correct|incorrect)\.?$/i', $r)) {
                            $this->fail($at, "rationale {$k} is too thin");
                        }
                    }
                }
                if (preg_match('/\b(all|none) of the above\b/i', implode(' ', $q['options']))) {
                    $this->fail($at, 'no all/none of the above');
                }
            }
            if (! $type->hasOptions() && trim((string) ($q['explanation'] ?? '')) === '') {
                $this->fail($at, 'explanation missing');
            }
            if ($type === QuestionType::MultiSelect && ! ($q['partial_credit'] ?? false)) {
                $this->fail($at, 'multi_select without partial_credit');
            }
            $bodies[] = $q;
        }

        if ($bodies === []) {
            return;
        }
        try {
            TestDraftValidator::validate([
                'title' => $where, 'subject' => 'english-language-arts', 'grade_level' => '9-12', 'questions' => $bodies,
            ]);
        } catch (ValidationException $e) {
            foreach ($e->errors() as $key => $messages) {
                $this->fail("{$where} {$key}", implode(' ', $messages));
            }
        }
    }

    /**
     * An item's provenance: `general knowledge` (craft and terminology, no
     * quoted text), or a citation carrying the quoted work's publication year
     * in parentheses -- which must be in the US public domain.
     */
    private function source(string $at, string $source): void
    {
        if (strcasecmp(trim($source), 'general knowledge') === 0) {
            return;
        }
        if (! preg_match_all('/\([^()]*?\b(1[0-9]{3})\)/', $source, $m)) {
            $this->fail($at, "source `{$source}` needs the work's publication year in parentheses, or `general knowledge`");

            return;
        }
        foreach ($m[1] as $year) {
            if ((int) $year > self::PUBLIC_DOMAIN_THROUGH) {
                $this->fail($at, "source `{$source}` is too recent to be in the public domain");
            }
        }
    }

    /** @param  list<mixed>  $texts */
    private function texts(string $where, array $texts): void
    {
        if ($texts === []) {
            $this->fail($where, '`texts` is empty');
        }
        foreach ($texts as $i => $text) {
            $at = "{$where} text #".($i + 1);
            foreach (['author', 'title', 'year', 'url'] as $key) {
                if (empty($text[$key])) {
                    $this->fail($at, "missing `{$key}`");

                    continue 2;
                }
            }
            if ((int) $text['year'] > self::PUBLIC_DOMAIN_THROUGH) {
                $this->fail($at, "{$text['title']} ({$text['year']}) is too recent to be in the public domain");
            }
            $host = parse_url((string) $text['url'], PHP_URL_HOST);
            if (! in_array($host, self::TEXT_HOSTS, true) || ! str_starts_with((string) $text['url'], 'https://')) {
                $this->fail($at, "url {$text['url']} is not an https link to an allowed host");
            }
        }
    }

    private function prose(string $file, int $minWords): void
    {
        $body = (string) file_get_contents($file);
        if (! Course::endsWithAttribution($body)) {
            $this->fail($this->rel($file), 'lacks the closing attribution block');
        }
        $words = str_word_count(strip_tags($body));
        if ($words < $minWords) {
            $this->fail($this->rel($file), "is {$words} words (want at least {$minWords})");
        }
    }

    /** @param  list<array<string, mixed>>  $questions */
    private function longestSet(array $questions): int
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

    /** Runs of at least $min consecutive items sharing one stimulus. @param  list<array<string, mixed>>  $questions */
    private function sets(array $questions, int $min): int
    {
        $sets = 0;
        $run = 0;
        $previous = null;
        foreach ($questions as $q) {
            $s = trim((string) ($q['stimulus'] ?? ''));
            $run = ($s !== '' && $s === $previous) ? $run + 1 : ($s !== '' ? 1 : 0);
            if ($run === $min) {
                $sets++;
            }
            $previous = $s;
        }

        return $sets;
    }

    private function rel(string $file): string
    {
        return ltrim(str_replace($this->course->dir, '', $file), '/');
    }

    private function fail(string $where, string $message): void
    {
        $this->problems[] = "{$where}: {$message}";
    }
}
