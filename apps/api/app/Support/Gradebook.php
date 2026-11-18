<?php

namespace App\Support;

use App\Models\Assignment;
use App\Models\Attempt;
use App\Models\Connection;
use App\Models\Course;
use App\Models\Test;
use App\Models\User;
use Illuminate\Support\Collection;

/**
 * The author's scores as a table, for a spreadsheet: one test's assignments,
 * or a whole course's students against its tests. The SPA turns it into a
 * CSV download. Same audience as the results page (TestAttemptsController):
 * the author's own assignments to students they are still connected with,
 * active ones only, and never self-practice or study progress.
 *
 * Scores are numbers (or null for nothing submitted yet), so a spreadsheet
 * can sum them; names are the only free text.
 */
final class Gradebook
{
    /** @return array{title: string, columns: list<string>, rows: list<list<string|int|float|null>>} */
    public static function forTest(User $teacher, Test $test): array
    {
        $assignments = self::assignments($teacher, collect([$test->id]));

        $rows = $assignments->map(function (Assignment $a) {
            $submitted = $a->attempts->filter(fn (Attempt $at) => $at->isSubmitted());
            $latest = $submitted->sortByDesc('id')->sortByDesc('submitted_at')->first();
            $best = self::best($submitted);

            return [
                $a->student->name,
                $a->due_at?->toDateString(),
                $latest?->submitted_at?->toDateTimeString(),
                self::number($latest?->score),
                self::number($best?->score),
                self::number($best?->max_score ?? $latest?->max_score),
                self::percent($best),
                $submitted->count(),
                $latest ? $latest->answers->whereNull('awarded')->count() : null,
            ];
        })->values()->all();

        return [
            'title' => $test->title,
            'columns' => ['Student', 'Due', 'Submitted', 'Latest score', 'Best score', 'Out of', 'Best %', 'Attempts', 'Answers to grade'],
            'rows' => $rows,
        ];
    }

    /**
     * Students down, the course's tests across in course order, each cell
     * the student's best submitted score; then how many they submitted and
     * their total over the tests they submitted.
     *
     * @return array{title: string, columns: list<string>, rows: list<list<string|int|float|null>>}
     */
    public static function forCourse(User $teacher, Course $course): array
    {
        $tests = $course->items()->whereNotNull('test_id')->orderBy('position')
            ->with(['test' => fn ($q) => $q->withSum('questions', 'points')])
            ->get()
            ->pluck('test')
            ->filter()
            ->unique('id')
            ->values();
        $byStudent = self::assignments($teacher, $tests->pluck('id'))->groupBy('student_id');

        $rows = $byStudent->map(function (Collection $assignments) use ($tests) {
            $byTest = $assignments->keyBy('test_id');
            $cells = [];
            $done = 0;
            $points = 0.0;
            $possible = 0.0;
            foreach ($tests as $test) {
                $best = self::best($byTest->get($test->id)?->attempts->filter(fn (Attempt $a) => $a->isSubmitted()) ?? collect());
                $cells[] = self::number($best?->score);
                if ($best) {
                    $done++;
                    $points += (float) $best->score;
                    $possible += (float) $best->max_score;
                }
            }

            return [
                $assignments->first()->student->name,
                ...$cells,
                $done,
                round($points, 2),
                round($possible, 2),
                $possible > 0 ? round(100 * $points / $possible, 1) : null,
            ];
        })->sortBy(fn (array $row) => mb_strtolower($row[0]))->values()->all();

        return [
            'title' => $course->title,
            'columns' => [
                'Student',
                ...$tests->map(fn (Test $t) => sprintf('%s (out of %s)', $t->title, self::number($t->questions_sum_points ?? 0)))->all(),
                'Tests submitted',
                'Points',
                'Possible',
                'Percent',
            ],
            'rows' => $rows,
        ];
    }

    /**
     * The teacher's assignments on these tests, to connected, active
     * students, oldest first, with their attempts and answers.
     *
     * @param  Collection<int, int>  $testIds
     * @return Collection<int, Assignment>
     */
    private static function assignments(User $teacher, Collection $testIds): Collection
    {
        return Assignment::whereIn('test_id', $testIds->all())
            ->whereIn('student_id', Connection::acceptedCounterpartIds($teacher))
            ->whereHas('student', fn ($q) => $q->whereNull('deactivated_at'))
            ->whereHas('test', fn ($q) => $q->where('user_id', $teacher->id))
            ->with(['student', 'attempts.answers'])
            ->orderBy('id')
            ->get();
    }

    /** The highest-scoring submitted attempt, the latest of a tie. */
    private static function best(Collection $submitted): ?Attempt
    {
        return $submitted->sortByDesc('id')->sortByDesc(fn (Attempt $a) => (float) $a->score)->first();
    }

    private static function number(mixed $value): int|float|null
    {
        if ($value === null) {
            return null;
        }
        $n = round((float) $value, 2);

        return floor($n) === $n ? (int) $n : $n;
    }

    private static function percent(?Attempt $attempt): ?float
    {
        return $attempt && (float) $attempt->max_score > 0
            ? round(100 * (float) $attempt->score / (float) $attempt->max_score, 1)
            : null;
    }
}
