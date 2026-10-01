<?php

namespace Database\Seeders;

use App\Enums\ConnectionStatus;
use App\Enums\Visibility;
use App\Models\Assignment;
use App\Models\Connection;
use App\Models\Material;
use App\Models\Test;
use App\Models\User;
use App\Services\MaterialWriter;
use App\Support\TestDraftValidator;
use App\Support\TestWriter;
use Carbon\CarbonImmutable;
use Database\Seeders\ApBiology\Course;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use RuntimeException;

/**
 * The AP Biology course, from YAML to rows. Idempotent: every test,
 * question and material carries a slug, so a re-run updates in place --
 * questions keep their ids (and so their answers), a guide's bytes are
 * rewritten at the same path, nothing is duplicated.
 *
 * Deliberately NOT gated by the registration switch: shell provisioning
 * must work while sign-ups are closed (CLAUDE.md).
 *
 *   php artisan db:seed --class=ApBiologySeeder
 */
class ApBiologySeeder extends Seeder
{
    public const PASSWORD = 'password';

    private Course $course;

    private User $teacher;

    private User $student;

    /** @var array<string, int> */
    private array $counts = ['tests' => 0, 'questions' => 0, 'materials' => 0, 'decks' => 0, 'cards' => 0, 'general_knowledge' => 0];

    public function __construct(private readonly ?string $dir = null) {}

    public function run(): void
    {
        $this->course = new Course($this->dir ?? Course::defaultDir());

        // 1. Validate every question before writing anything. A bad item
        //    fails loudly with its file and index; nothing is half-seeded.
        $plan = $this->plan();

        $this->accounts();

        foreach ($plan['tests'] as $spec) {
            $this->test($spec);
        }
        foreach ($plan['materials'] as $spec) {
            $this->material($spec);
        }

        $this->command?->info(sprintf(
            'AP Biology: %d tests (%d questions), %d materials of which %d decks (%d cards); %d items marked general knowledge.',
            $this->counts['tests'], $this->counts['questions'], $this->counts['materials'], $this->counts['decks'], $this->counts['cards'], $this->counts['general_knowledge'],
        ));
    }

    /**
     * Everything to write, shaped and validated. Tests carry their already-
     * validated question bodies plus the per-question slugs; materials carry
     * their bytes.
     *
     * @return array{tests: list<array<string, mixed>>, materials: list<array<string, mixed>>}
     */
    private function plan(): array
    {
        $c = $this->course;
        $tests = [];
        $materials = [];

        foreach ($c->weeks() as $week => ['file' => $file, 'data' => $data]) {
            $unit = $c->unitForWeek($week);
            $topics = (array) ($data['topics'] ?? []);
            $title = (string) ($data['title'] ?? "Week {$week}");

            if (isset($data['quiz'])) {
                $tests[] = $this->testSpec(
                    slug: sprintf('apbio-w%02d-quiz', $week),
                    title: $c->quizTitle($week, $title),
                    description: $c->describe($topics, $data['quiz']['description'] ?? null, $unit['number'] ?? null),
                    questions: (array) ($data['quiz']['questions'] ?? []),
                    file: $file,
                    week: $week,
                );
            }

            if (isset($data['guide'])) {
                $materials[] = [
                    'slug' => sprintf('apbio-w%02d-guide', $week),
                    'title' => $c->guideTitle($week, $title),
                    'description' => $c->describe($topics, $data['guide_description'] ?? null, $unit['number'] ?? null),
                    'name' => sprintf('week-%02d-study-guide.md', $week),
                    'body' => $this->read("{$c->dir}/{$data['guide']}"),
                ];
            }

            if (! empty($data['flashcards'])) {
                $deckTitle = $c->deckTitle($week, $title);
                $materials[] = [
                    'slug' => sprintf('apbio-w%02d-cards', $week),
                    'title' => $deckTitle,
                    'description' => $c->describe($topics, $data['flashcards_description'] ?? null, $unit['number'] ?? null),
                    'name' => sprintf('week-%02d.flashcards.md', $week),
                    'body' => Course::deckMarkdown($deckTitle, (array) $data['flashcards']),
                    'cards' => count((array) $data['flashcards']),
                ];
            }
        }

        foreach ($c->unitExams() as $number => ['file' => $file, 'data' => $data]) {
            $unit = $c->unit($number);
            $tests[] = $this->testSpec(
                slug: sprintf('apbio-u%02d-exam', $number),
                title: $c->unitExamTitle($number),
                description: $c->describe(array_keys((array) $unit['topics']), $data['description'] ?? null, $number),
                questions: (array) ($data['questions'] ?? []),
                file: $file,
                week: max((array) $unit['weeks']),
            );
        }

        foreach ($c->unitSummaries() as $number => $file) {
            $unit = $c->unit($number);
            $materials[] = [
                'slug' => sprintf('apbio-u%02d-summary', $number),
                'title' => $c->unitSummaryTitle($number),
                'description' => $c->describe(array_keys((array) $unit['topics']), null, $number),
                'name' => sprintf('unit-%02d-summary.md', $number),
                'body' => $this->read($file),
            ];
        }

        if ($exam = $c->practiceExam()) {
            $tests[] = $this->testSpec(
                slug: 'apbio-practice-exam',
                title: $c->practiceExamTitle(),
                description: $c->describe([], $exam['data']['description'] ?? null),
                questions: (array) ($exam['data']['questions'] ?? []),
                file: $exam['file'],
                week: (int) ($c->config['review']['practice_exam_week'] ?? 34),
            );
        }

        if ($guide = $c->examPrepGuide()) {
            $materials[] = [
                'slug' => 'apbio-exam-prep',
                'title' => $c->examPrepTitle(),
                'description' => 'Format, timing, the formula sheet, the task verbs and a two-week review plan.',
                'name' => 'exam-prep-guide.md',
                'body' => $this->read($guide),
            ];
        }

        $cap = (int) config('materials.max_files_per_teacher');
        if (count($materials) > $cap) {
            throw new RuntimeException(sprintf('The course has %d materials; the per-teacher cap is %d.', count($materials), $cap));
        }

        return ['tests' => $tests, 'materials' => $materials];
    }

    /** @param  array<int, array<string, mixed>>  $questions @return array<string, mixed> */
    private function testSpec(string $slug, string $title, string $description, array $questions, string $file, int $week): array
    {
        $slugs = [];
        $bodies = [];
        foreach (array_values($questions) as $i => $q) {
            $shaped = Course::shapeQuestion((array) $q, $file, $i + 1);
            $slugs[] = $shaped['slug'];
            $bodies[] = $shaped['question'];
            if (strcasecmp($shaped['source'], 'general knowledge') === 0) {
                $this->counts['general_knowledge']++;
            }
        }

        try {
            $validated = TestDraftValidator::validate([
                'title' => $title,
                'description' => $description,
                'subject' => $this->course->config['subject'],
                'grade_level' => $this->course->config['grade_level'],
                'questions' => $bodies,
            ]);
        } catch (ValidationException $e) {
            // The first error, with the file and the 1-based item index the
            // author will look for. `questions.3.prompt` -> item #4.
            $key = array_key_first($e->errors());
            $index = preg_match('/^questions\.(\d+)/', (string) $key, $m) ? ' question #'.($m[1] + 1).' ('.($slugs[(int) $m[1]] ?? '?').')' : '';
            throw new RuntimeException("{$file}{$index}: ".implode(' ', $e->errors()[$key]), previous: $e);
        }

        return ['slug' => $slug, 'week' => $week, 'slugs' => $slugs] + $validated;
    }

    private function accounts(): void
    {
        $this->teacher = $this->account($this->course->config['teacher'], 'teacher');
        $this->student = $this->account($this->course->config['student'], 'student');

        $key = Connection::pairKey($this->teacher->id, $this->student->id);
        $connection = Connection::firstOrNew(['pair_key' => $key], [
            'requester_id' => $this->teacher->id,
            'addressee_id' => $this->student->id,
        ]);
        $connection->status = ConnectionStatus::Accepted;
        $connection->save();
    }

    /** @param  array{name: string, email: string}  $spec */
    private function account(array $spec, string $role): User
    {
        $user = User::firstOrNew(['email' => $spec['email']]);
        if (! $user->exists) {
            $user->name = $spec['name'];
            $user->password = Hash::make(self::PASSWORD);
            $user->role = $role;
        }
        $user->email_verified_at ??= now();
        $user->deactivated_at = null;
        $user->save();

        return $user;
    }

    /** @param  array<string, mixed>  $spec */
    private function test(array $spec): void
    {
        DB::transaction(function () use ($spec) {
            $test = Test::firstOrNew(['slug' => $spec['slug']]);
            $test->user_id = $this->teacher->id;
            $test->title = $spec['title'];
            $test->description = $spec['description'];
            $test->subject = $spec['subject'];
            $test->grade_level = $spec['grade_level'];
            $test->visibility = Visibility::Public;
            $test->published_at ??= now();
            $test->save();

            // Map each YAML slug to its existing row so TestWriter updates in
            // place and answers keep their foreign keys; new slugs create.
            $existing = $test->questions()->whereNotNull('slug')->pluck('id', 'slug');
            $questions = [];
            foreach ($spec['questions'] as $i => $q) {
                $id = $existing[$spec['slugs'][$i]] ?? null;
                $questions[] = $id ? ['id' => $id] + $q : $q;
            }
            TestWriter::syncQuestions($test, $questions);

            // Position i is YAML item i (a clean list); stamp the slugs.
            foreach ($test->questions()->get() as $i => $row) {
                if ($row->slug !== $spec['slugs'][$i]) {
                    $row->forceFill(['slug' => $spec['slugs'][$i]])->save();
                }
            }

            $assignment = Assignment::firstOrNew(['test_id' => $test->id, 'student_id' => $this->student->id]);
            $assignment->teacher_id = $this->teacher->id;
            $assignment->due_at = $this->dueDate($spec['week']);
            $assignment->save();

            $this->counts['tests']++;
            $this->counts['questions'] += count($spec['questions']);
        });
    }

    /** @param  array<string, mixed>  $spec */
    private function material(array $spec): void
    {
        $attrs = [
            'title' => $spec['title'],
            'description' => $spec['description'],
            'subject' => $this->course->config['subject'],
            'grade_level' => $this->course->config['grade_level'],
        ];

        $material = Material::where('slug', $spec['slug'])->first();
        if ($material) {
            $material->update($attrs + ['visibility' => Visibility::Public, 'published_at' => $material->published_at ?? now()]);
            MaterialWriter::replace($material, $spec['body']);
        } else {
            MaterialWriter::create($this->teacher, $spec['body'], $spec['name'], $attrs + [
                'slug' => $spec['slug'],
                'visibility' => Visibility::Public,
                'published_at' => now(),
            ]);
        }

        $this->counts['materials']++;
        if (isset($spec['cards'])) {
            $this->counts['decks']++;
            $this->counts['cards'] += $spec['cards'];
        }
    }

    /** Sunday ending the week, or null when the course has no calendar. */
    private function dueDate(int $week): ?CarbonImmutable
    {
        $start = $this->course->config['start_date'] ?? null;
        if (! $start) {
            return null;
        }

        // symfony/yaml hands an unquoted date back as a Unix timestamp.
        $monday = match (true) {
            is_int($start) => CarbonImmutable::createFromTimestampUTC($start)->startOfDay(),
            $start instanceof \DateTimeInterface => CarbonImmutable::instance($start)->startOfDay(),
            default => CarbonImmutable::parse((string) $start)->startOfDay(),
        };

        return $monday->addWeeks($week - 1)->addDays(6)->endOfDay();
    }

    private function read(string $path): string
    {
        if (! is_file($path)) {
            throw new RuntimeException("Missing file: {$path}");
        }

        return (string) file_get_contents($path);
    }
}
