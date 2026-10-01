<?php

namespace Database\Seeders\ApBiology;

use RuntimeException;
use Symfony\Component\Yaml\Yaml;

/**
 * The AP Biology course as data: course.yaml plus every week, unit exam and
 * review file under one directory. Loads, shapes and validates; writes
 * nothing. ApBiologySeeder and ApBiologyContentTest both read through here
 * so the two can never disagree about what a file means.
 *
 * Titles and slugs are composed HERE, from the week/unit numbers, so the
 * YAML never spells the convention out: `AP Biology · Week 07 · Quiz · …`
 * sorts in course order when the library sorts by title.
 */
final class Course
{
    public const PREFIX = 'AP Biology';

    public const ATTRIBUTION_MARKERS = ['OpenStax', 'https://creativecommons.org/licenses/by/4.0/', 'adapted from the original'];

    /** @var array<string, mixed> */
    public readonly array $config;

    public function __construct(public readonly string $dir)
    {
        $this->config = self::yaml("{$dir}/course.yaml");
        foreach (['teacher', 'student', 'subject', 'grade_level', 'units'] as $key) {
            if (! array_key_exists($key, $this->config)) {
                throw new RuntimeException("course.yaml: missing `{$key}`");
            }
        }
    }

    public static function defaultDir(): string
    {
        return database_path('seeders/data/ap-biology');
    }

    /** @return array<string, mixed> */
    public static function yaml(string $path): array
    {
        if (! is_file($path)) {
            throw new RuntimeException("Missing file: {$path}");
        }
        $data = Yaml::parseFile($path);
        if (! is_array($data)) {
            throw new RuntimeException("Not a mapping: {$path}");
        }

        return $data;
    }

    /** Every CED topic code -> its title, across all units. @return array<string, string> */
    public function topics(): array
    {
        $out = [];
        foreach ($this->config['units'] as $unit) {
            foreach ((array) ($unit['topics'] ?? []) as $code => $title) {
                $out[(string) $code] = $title;
            }
        }

        return $out;
    }

    /** The unit a week belongs to, or null in the review weeks. @return array<string, mixed>|null */
    public function unitForWeek(int $week): ?array
    {
        foreach ($this->config['units'] as $unit) {
            if (in_array($week, (array) $unit['weeks'], true)) {
                return $unit;
            }
        }

        return null;
    }

    /** The unit by number. @return array<string, mixed> */
    public function unit(int $number): array
    {
        foreach ($this->config['units'] as $unit) {
            if ((int) $unit['number'] === $number) {
                return $unit;
            }
        }
        throw new RuntimeException("course.yaml: no unit {$number}");
    }

    /**
     * Every week file present, keyed by week number, ascending. A unit
     * directory is `unit-NN-<slug>`; a week file inside it is `week-NN.yaml`.
     *
     * @return array<int, array{file: string, data: array<string, mixed>}>
     */
    public function weeks(): array
    {
        $out = [];
        foreach (glob("{$this->dir}/unit-*/week-*.yaml") ?: [] as $file) {
            $data = self::yaml($file);
            $week = (int) ($data['week'] ?? 0);
            if ($week < 1) {
                throw new RuntimeException("{$file}: missing `week`");
            }
            if (isset($out[$week])) {
                throw new RuntimeException("Week {$week} is defined twice: {$out[$week]['file']} and {$file}");
            }
            $out[$week] = ['file' => $file, 'data' => $data];
        }
        ksort($out);

        return $out;
    }

    /** @return array<int, array{file: string, data: array<string, mixed>}> keyed by unit number */
    public function unitExams(): array
    {
        $out = [];
        foreach (glob("{$this->dir}/unit-*/unit-exam.yaml") ?: [] as $file) {
            $data = self::yaml($file);
            $out[(int) $data['unit']] = ['file' => $file, 'data' => $data];
        }
        ksort($out);

        return $out;
    }

    /** @return array{file: string, data: array<string, mixed>}|null */
    public function practiceExam(): ?array
    {
        $file = "{$this->dir}/review/practice-exam.yaml";

        return is_file($file) ? ['file' => $file, 'data' => self::yaml($file)] : null;
    }

    /** Unit summary markdown paths keyed by unit number. @return array<int, string> */
    public function unitSummaries(): array
    {
        $out = [];
        foreach (glob("{$this->dir}/unit-*/unit-summary.md") ?: [] as $file) {
            preg_match('/unit-(\d+)-/', basename(dirname($file)), $m);
            $out[(int) $m[1]] = $file;
        }
        ksort($out);

        return $out;
    }

    public function examPrepGuide(): ?string
    {
        $file = "{$this->dir}/review/exam-prep-guide.md";

        return is_file($file) ? $file : null;
    }

    /** The week number a topic is first taught, from the week files' `topics` lists. @return array<string, int> */
    public function topicFirstWeek(): array
    {
        $out = [];
        foreach ($this->weeks() as $week => ['data' => $data]) {
            foreach ((array) ($data['topics'] ?? []) as $code) {
                $out[(string) $code] ??= $week;
            }
        }

        return $out;
    }

    // ---- composition -------------------------------------------------

    public static function weekLabel(int $week): string
    {
        return sprintf('Week %02d', $week);
    }

    public function quizTitle(int $week, string $title): string
    {
        return self::PREFIX.' · '.self::weekLabel($week).' · Quiz · '.$title;
    }

    public function guideTitle(int $week, string $title): string
    {
        return self::PREFIX.' · '.self::weekLabel($week).' · Study Guide · '.$title;
    }

    public function deckTitle(int $week, string $title): string
    {
        return self::PREFIX.' · '.self::weekLabel($week).' · Flashcards · '.$title;
    }

    public function unitExamTitle(int $unit): string
    {
        $u = $this->unit($unit);

        return self::PREFIX.' · '.self::weekLabel(max((array) $u['weeks']))." · Unit {$unit} Exam · ".$u['title'];
    }

    public function unitSummaryTitle(int $unit): string
    {
        $u = $this->unit($unit);

        return self::PREFIX.' · '.self::weekLabel(max((array) $u['weeks']))." · Unit {$unit} Summary · ".$u['title'];
    }

    public function practiceExamTitle(): string
    {
        return self::PREFIX.' · '.self::weekLabel((int) ($this->config['review']['practice_exam_week'] ?? 34)).' · Practice Exam';
    }

    public function examPrepTitle(): string
    {
        return self::PREFIX.' · '.self::weekLabel((int) ($this->config['review']['prep_guide_week'] ?? 33)).' · Exam Prep Guide';
    }

    /** The description a test or material carries: the CED line first, then the authored text. */
    public function describe(array $topicCodes, ?string $authored, ?int $unit = null): string
    {
        $lines = [];
        if ($topicCodes !== []) {
            $lines[] = 'CED topics '.implode(', ', array_map('strval', $topicCodes)).($unit ? " · Unit {$unit} ".$this->unit($unit)['title'] : '');
        }
        if (filled($authored)) {
            $lines[] = trim($authored);
        }

        return implode("\n\n", $lines);
    }

    /**
     * The YAML question as the API accepts it: provenance keys lifted off,
     * block-scalar trailing newlines trimmed, `points` defaulted.
     *
     * @param  array<string, mixed>  $q
     * @return array{slug: string, topic_code: string, source: string, question: array<string, mixed>}
     */
    public static function shapeQuestion(array $q, string $file, int $index): array
    {
        foreach (['slug', 'type', 'topic_code', 'source', 'prompt', 'answer'] as $key) {
            if (! array_key_exists($key, $q)) {
                throw new RuntimeException("{$file} question #{$index}: missing `{$key}`");
            }
        }
        $meta = ['slug' => (string) $q['slug'], 'topic_code' => (string) $q['topic_code'], 'source' => (string) $q['source']];
        unset($q['slug'], $q['topic_code'], $q['source']);

        $trim = fn ($v) => is_string($v) ? rtrim($v) : $v;
        foreach (['prompt', 'stimulus', 'explanation'] as $key) {
            if (array_key_exists($key, $q)) {
                $q[$key] = $trim($q[$key]);
            }
        }
        foreach (['options', 'option_explanations'] as $key) {
            if (isset($q[$key]) && is_array($q[$key])) {
                $q[$key] = array_map($trim, $q[$key]);
            }
        }
        if (isset($q['answer']) && is_array($q['answer']) && array_is_list($q['answer'])) {
            $q['answer'] = array_map($trim, $q['answer']);
        } elseif (isset($q['answer']) && is_string($q['answer'])) {
            $q['answer'] = rtrim($q['answer']);
        }
        $q['points'] = (int) ($q['points'] ?? 1);

        return $meta + ['question' => $q];
    }

    /** The deck as the SPA's flashcard reader expects it. @param array<int, array<string, mixed>> $cards */
    public static function deckMarkdown(string $title, array $cards): string
    {
        $out = ["# {$title}", ''];
        foreach ($cards as $card) {
            $out[] = '## '.trim((string) $card['front']);
            $out[] = trim((string) $card['back']);
            if (filled($card['hint'] ?? null)) {
                $out[] = '';
                $out[] = 'Hint: '.trim((string) $card['hint']);
            }
            if (filled($card['topic_code'] ?? null)) {
                $out[] = 'Topic: '.trim((string) $card['topic_code']);
            }
            $out[] = '';
        }

        return implode("\n", $out);
    }

    public static function endsWithAttribution(string $markdown): bool
    {
        $tail = substr(rtrim($markdown), -1200);
        foreach (self::ATTRIBUTION_MARKERS as $marker) {
            if (! str_contains($tail, $marker)) {
                return false;
            }
        }

        return true;
    }
}
