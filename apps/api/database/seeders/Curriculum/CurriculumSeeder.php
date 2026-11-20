<?php

namespace Database\Seeders\Curriculum;

use App\Enums\ConnectionStatus;
use App\Enums\Role;
use App\Enums\SlugKind;
use App\Enums\SlugStatus;
use App\Enums\Visibility;
use App\Models\Assignment;
use App\Models\Connection;
use App\Models\Course as CourseRow;
use App\Models\Figure;
use App\Models\Material;
use App\Models\SiteSetting;
use App\Models\Test;
use App\Models\UrlSlug;
use App\Models\User;
use App\Services\FigureWriter;
use App\Services\MaterialWriter;
use App\Support\CourseWriter;
use App\Support\MaterialQuota;
use App\Support\Slugs;
use App\Support\Standards;
use App\Support\TestDraftValidator;
use App\Support\TestWriter;
use Carbon\CarbonImmutable;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use RuntimeException;

/**
 * A seeded course, from YAML to rows: one subclass per course, naming its
 * data directory (ApBiologySeeder, ApUsHistorySeeder, ApLiteratureSeeder). Idempotent: every test,
 * question, material and the course itself carry a slug, so a re-run updates in place --
 * questions keep their ids (and so their answers), a guide's bytes are
 * rewritten at the same path, nothing is duplicated.
 *
 * Deliberately NOT gated by the registration switch: shell provisioning
 * must work while sign-ups are closed (CLAUDE.md).
 *
 *   php artisan db:seed --class=ApBiologySeeder          (demo accounts)
 *   php artisan course:seed-ap-biology --teacher=EMAIL   (your own account)
 *
 * Every test, material and course slug starts with course.yaml's `slug`.
 *
 * The owner is either an existing account named by the caller -- which must
 * already be a verified, active teacher and is never created or modified --
 * or the demo teacher from course.yaml. The same goes for the student, who
 * can also be left out entirely. Demo accounts get the documented password
 * only in local and testing; anywhere else they get a random one, printed
 * once, so a public site never carries a login anyone can read in the repo.
 */
abstract class CurriculumSeeder extends Seeder
{
    public const PASSWORD = 'password';

    private Course $course;

    private User $teacher;

    private ?User $student = null;

    /** Order within a week on the course page. */
    private const RANK_GUIDE = 0;

    private const RANK_CARDS = 1;

    private const RANK_QUIZ = 2;

    private const RANK_UNIT_SUMMARY = 3;

    private const RANK_UNIT_EXAM = 4;

    /** @var array<string, int> */
    private array $counts = ['tests' => 0, 'questions' => 0, 'materials' => 0, 'decks' => 0, 'cards' => 0, 'general_knowledge' => 0];

    /**
     * @param  string|null  $teacherEmail  an existing teacher to own the course; null = the demo teacher
     * @param  string|null  $studentEmail  an existing student to assign it to; null = the demo student
     * @param  bool  $withStudent  false = no student, no connection, no assignments
     */
    public function __construct(
        private readonly ?string $dir = null,
        private readonly ?string $teacherEmail = null,
        private readonly ?string $studentEmail = null,
        private readonly bool $withStudent = true,
    ) {}

    /** The course's data directory under database/seeders/data. */
    abstract public static function defaultDir(): string;

    public function run(): void
    {
        $this->course = new Course($this->dir ?? static::defaultDir());

        // 1. Validate every question before writing anything. A bad item
        //    fails loudly with its file and index; nothing is half-seeded.
        //    A course built on another (AP Calculus BC on AB) validates the
        //    base too, and the owner's quota covers both.
        $plan = $this->plan();
        $base = $this->course->base !== null ? $this->baseSeeder() : null;
        $all = [...($base?->plannedMaterials() ?? []), ...$plan['materials']];

        // 2. Resolve the accounts. Named accounts are checked (and the
        //    owner's quota with them) before anything is written.
        $this->accounts($all);

        // 3. The base course's rows must be this owner's own: seed it first,
        //    for the same teacher and without a student (idempotent, like any
        //    run), unless it belongs to someone else.
        if ($base !== null) {
            $this->assertBaseOwner();
            $base->run();
        }

        foreach ($plan['tests'] as $spec) {
            $this->test($spec);
        }
        foreach ($plan['materials'] as $spec) {
            $this->material($spec);
        }
        $this->assignReused($plan['reused']);
        $course = $this->course($plan);

        $this->command?->info(sprintf(
            '%s: %d tests (%d questions), %d materials of which %d decks (%d cards); %d items marked general knowledge.',
            $this->course->prefix, $this->counts['tests'], $this->counts['questions'], $this->counts['materials'], $this->counts['decks'], $this->counts['cards'], $this->counts['general_knowledge'],
        ));
        $this->command?->info(sprintf(
            'Course #%d "%s" is %s.%s',
            $course->id, $course->title, $course->visibility->value,
            $course->isPublic() ? '' : ' Its owner can publish it from the course page.',
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
        $this->counts['general_knowledge'] = 0;
        $c = $this->course;
        $tests = [];
        $materials = [];

        $reused = [];

        foreach ($c->weeks() as $week => ['file' => $file, 'data' => $data]) {
            $unit = $c->unitForWeek($week);
            if (Course::isReuse($data)) {
                // The base course's own rows, placed at this week of this course.
                foreach ($c->reusedWeeks($data) as $i => $w) {
                    // `sub` keeps each reused week's guide, cards and quiz together, in list order.
                    $at = ['week' => $week, 'sub' => $i, 'section' => $c->sectionTitle($unit)];
                    $reused[] = ['kind' => 'material', 'rank' => self::RANK_GUIDE, 'slug' => $c->base->slug.sprintf('-w%02d-guide', $w)] + $at;
                    $reused[] = ['kind' => 'material', 'rank' => self::RANK_CARDS, 'slug' => $c->base->slug.sprintf('-w%02d-cards', $w)] + $at;
                    $reused[] = ['kind' => 'test', 'rank' => self::RANK_QUIZ, 'slug' => $c->base->slug.sprintf('-w%02d-quiz', $w)] + $at;
                }

                continue;
            }
            $topics = (array) ($data['topics'] ?? []);
            $title = (string) ($data['title'] ?? "Week {$week}");
            $section = $c->sectionTitle($unit);

            if (isset($data['quiz'])) {
                $tests[] = $this->testSpec(
                    slug: $this->slug(sprintf('w%02d-quiz', $week)),
                    title: $c->quizTitle($week, $title),
                    description: $c->describe($topics, $data['quiz']['description'] ?? null, $unit['number'] ?? null),
                    questions: (array) ($data['quiz']['questions'] ?? []),
                    file: $file,
                    week: $week,
                ) + ['rank' => self::RANK_QUIZ, 'section' => $section];
            }

            if (isset($data['guide'])) {
                $materials[] = [
                    'week' => $week, 'rank' => self::RANK_GUIDE, 'section' => $section,
                    'slug' => $this->slug(sprintf('w%02d-guide', $week)),
                    'title' => $c->guideTitle($week, $title),
                    'description' => $c->describe($topics, $data['guide_description'] ?? null, $unit['number'] ?? null),
                    'name' => sprintf('week-%02d-study-guide.md', $week),
                    'standards' => $this->standards(array_map('strval', $topics)),
                    'body' => $this->read("{$c->dir}/{$data['guide']}"),
                ];
            }

            if (! empty($data['flashcards'])) {
                $deckTitle = $c->deckTitle($week, $title);
                $materials[] = [
                    'week' => $week, 'rank' => self::RANK_CARDS, 'section' => $section,
                    'slug' => $this->slug(sprintf('w%02d-cards', $week)),
                    'title' => $deckTitle,
                    'description' => $c->describe($topics, $data['flashcards_description'] ?? null, $unit['number'] ?? null),
                    'name' => sprintf('week-%02d.flashcards.md', $week),
                    'standards' => $this->standards(array_map('strval', $topics)),
                    'body' => Course::deckMarkdown($deckTitle, (array) $data['flashcards']),
                    'cards' => count((array) $data['flashcards']),
                ];
            }
        }

        foreach ($c->config['units'] as $unit) {
            if ($c->reusesUnitExam($unit)) {
                $at = ['week' => max((array) $unit['weeks']), 'sub' => PHP_INT_MAX, 'section' => $c->sectionTitle($unit)];
                $reused[] = ['kind' => 'material', 'rank' => self::RANK_UNIT_SUMMARY, 'slug' => $c->base->slug.sprintf('-u%02d-summary', $unit['number'])] + $at;
                $reused[] = ['kind' => 'test', 'rank' => self::RANK_UNIT_EXAM, 'slug' => $c->base->slug.sprintf('-u%02d-exam', $unit['number'])] + $at;
            }
        }

        foreach ($c->unitExams() as $number => ['file' => $file, 'data' => $data]) {
            $unit = $c->unit($number);
            $tests[] = $this->testSpec(
                slug: $this->slug(sprintf('u%02d-exam', $number)),
                title: $c->unitExamTitle($number),
                description: $c->describe($c->unitTopics($number), $data['description'] ?? null, $number),
                questions: (array) ($data['questions'] ?? []),
                file: $file,
                week: max((array) $unit['weeks']),
            ) + ['rank' => self::RANK_UNIT_EXAM, 'section' => $c->sectionTitle($unit)];
        }

        foreach ($c->unitSummaries() as $number => $file) {
            $unit = $c->unit($number);
            $materials[] = [
                'week' => max((array) $unit['weeks']), 'rank' => self::RANK_UNIT_SUMMARY, 'section' => $c->sectionTitle($unit),
                'slug' => $this->slug(sprintf('u%02d-summary', $number)),
                'title' => $c->unitSummaryTitle($number),
                'description' => $c->describe($c->unitTopics($number), null, $number),
                'name' => sprintf('unit-%02d-summary.md', $number),
                'standards' => $this->standards($c->unitTopics($number)),
                'body' => $this->read($file),
            ];
        }

        if ($exam = $c->practiceExam()) {
            $tests[] = $this->testSpec(
                slug: $this->slug('practice-exam'),
                title: $c->practiceExamTitle(),
                description: $c->describe([], $exam['data']['description'] ?? null),
                questions: (array) ($exam['data']['questions'] ?? []),
                file: $exam['file'],
                week: (int) ($c->config['review']['practice_exam_week'] ?? 34),
            ) + ['rank' => self::RANK_QUIZ, 'section' => $c->sectionTitle(null)];
        }

        if ($guide = $c->examPrepGuide()) {
            $materials[] = [
                'week' => (int) ($c->config['review']['prep_guide_week'] ?? 33), 'rank' => self::RANK_GUIDE, 'section' => $c->sectionTitle(null),
                'slug' => $this->slug('exam-prep'),
                'title' => $c->examPrepTitle(),
                'description' => trim((string) ($c->config['review']['prep_guide_description'] ?? '')),
                'name' => 'exam-prep-guide.md',
                'body' => $this->read($guide),
            ];
        }

        $cap = MaterialQuota::maxFiles();
        if (count($materials) > $cap) {
            throw new RuntimeException(sprintf('The course has %d materials; the per-teacher cap is %d.', count($materials), $cap));
        }

        return ['tests' => $tests, 'materials' => $materials, 'reused' => $reused];
    }

    /** @param  array<int, array<string, mixed>>  $questions @return array<string, mixed> */
    private function testSpec(string $slug, string $title, string $description, array $questions, string $file, int $week): array
    {
        $slugs = [];
        $bodies = [];
        $figures = [];
        $codes = [];
        foreach (array_values($questions) as $i => $q) {
            $shaped = Course::shapeQuestion((array) $q, $file, $i + 1);
            $slugs[] = $shaped['slug'];
            $codes[] = $shaped['topic_code'];
            // A picture is a file path relative to the course directory; it
            // becomes a figure id when the test is written. Validate the alt
            // text now with a placeholder id, so a missing one names the item.
            $figures[] = isset($shaped['question']['figure']) ? (string) $shaped['question']['figure'] : null;
            unset($shaped['question']['figure']);
            if ($figures[$i] !== null) {
                $shaped['question']['figure_id'] = 0;
            }
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

        return ['slug' => $slug, 'week' => $week, 'slugs' => $slugs, 'figures' => $figures, 'standards' => $this->standards($codes)] + $validated;
    }

    /** @param  list<array<string, mixed>>  $materials */
    private function accounts(array $materials): void
    {
        $teacher = $this->teacherEmail !== null ? $this->existing($this->teacherEmail, Role::Teacher, '--teacher') : null;
        $student = ($this->withStudent && $this->studentEmail !== null) ? $this->existing($this->studentEmail, Role::Student, '--student') : null;

        if ($teacher !== null) {
            $this->assertRoomFor($teacher, $materials);
        }

        $this->teacher = $teacher ?? $this->demo($this->course->config['teacher'], Role::Teacher);
        if ($teacher === null) {
            $this->fitDemoQuota($materials);
            $this->assertRoomFor($this->teacher, $materials);
        }
        $this->student = $this->withStudent ? ($student ?? $this->demo($this->course->config['student'], Role::Student)) : null;

        if ($this->student === null) {
            return;
        }

        $key = Connection::pairKey($this->teacher->id, $this->student->id);
        $connection = Connection::firstOrNew(['pair_key' => $key], [
            'requester_id' => $this->teacher->id,
            'addressee_id' => $this->student->id,
        ]);
        $connection->status = ConnectionStatus::Accepted;
        $connection->save();
    }

    /**
     * An account the caller named. It must already exist with exactly the
     * expected role (an allowlist: an admin is not a teacher here) and be
     * able to sign in; it is never created, verified, reactivated or given
     * a password by the seeder.
     */
    private function existing(string $email, Role $role, string $flag): User
    {
        $user = User::where('email', $email)->first();

        if ($user === null) {
            throw new RuntimeException("{$flag}: No account uses {$email}. Create it first; the seeder never creates an account you name.");
        }
        if ($user->role !== $role) {
            throw new RuntimeException("{$flag}: {$email} is a {$user->role->value}, not a {$role->value}.");
        }
        if (! $user->isActive()) {
            throw new RuntimeException("{$flag}: {$email} is deactivated.");
        }
        if ($user->email_verified_at === null) {
            throw new RuntimeException("{$flag}: {$email} has not verified its email (not verified accounts cannot sign in).");
        }

        return $user;
    }

    /**
     * The course's files must fit beside the owner's other materials. Checked
     * up front: MaterialWriter would otherwise refuse one file part way
     * through a run that has already written the tests.
     *
     * @param  list<array<string, mixed>>  $materials
     */
    private function assertRoomFor(User $owner, array $materials): void
    {
        $slugs = array_column($materials, 'slug');
        $others = Material::query()
            ->where('user_id', $owner->id)
            ->where(fn ($q) => $q->whereNull('slug')->orWhereNotIn('slug', $slugs))
            ->selectRaw('COUNT(*) as files, COALESCE(SUM(size_bytes), 0) as bytes')
            ->first();

        $files = (int) $others->files + count($materials);
        $bytes = (int) $others->bytes + array_sum(array_map(fn ($m) => strlen($m['body']), $materials));
        $maxFiles = MaterialQuota::maxFiles();
        $maxBytes = (int) config('materials.max_bytes_per_teacher');

        if ($files > $maxFiles) {
            throw new RuntimeException(sprintf(
                'The course needs %d materials and %s already has %d others; the per-teacher cap is %d (raise it under Materials on the admin Site settings page).',
                count($materials), $owner->email, (int) $others->files, $maxFiles,
            ));
        }
        if ($bytes > $maxBytes) {
            throw new RuntimeException(sprintf('The course would take %s over the per-teacher storage cap.', $owner->email));
        }
    }

    /**
     * A demo account from course.yaml, created on first run. The documented
     * password only where no one else can reach the site; otherwise a random
     * one, shown once.
     *
     * @param  array{name: string, email: string}  $spec
     */
    private function demo(array $spec, Role $role): User
    {
        $user = User::firstOrNew(['email' => $spec['email']]);

        if ($user->exists && $user->role !== $role) {
            throw new RuntimeException("course.yaml: {$spec['email']} already exists as a {$user->role->value}, not a {$role->value}.");
        }

        if (! $user->exists) {
            $local = app()->environment(['local', 'testing']);
            $password = $local ? self::PASSWORD : Str::password(24, symbols: false);
            $user->name = $spec['name'];
            $user->password = Hash::make($password);
            $user->role = $role;

            if (! $local) {
                $this->command?->warn("Created {$spec['email']} with password: {$password}");
                $this->command?->warn('It is shown once. Store it now, or reset it from the login page.');
            }
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
            if ($this->course->topicsAreStandards()) {
                $test->standards = $spec['standards'];
            }
            $test->visibility = Visibility::Public;
            $test->published_at ??= now();
            $test->save();

            // A seeded question the teacher deleted is soft-deleted with its
            // slug still on the row, and (test_id, slug) is unique across
            // trashed rows too. Restore it so the YAML item maps back onto
            // its own row -- keeping its id, so past answers stay attached --
            // instead of creating a second row that collides on the slug.
            // The YAML is the source of truth for slugged content.
            $test->questions()->onlyTrashed()->whereIn('slug', $spec['slugs'])->restore();

            // Map each YAML slug to its existing row so TestWriter updates in
            // place and answers keep their foreign keys; new slugs create.
            $existing = $test->questions()->whereNotNull('slug')->pluck('id', 'slug');
            $questions = [];
            foreach ($spec['questions'] as $i => $q) {
                unset($q['figure_id']);
                if (($path = $spec['figures'][$i] ?? null) !== null) {
                    $q['figure_id'] = $this->figure($path)->id;
                }
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

            if ($this->student !== null) {
                $assignment = Assignment::firstOrNew(['test_id' => $test->id, 'student_id' => $this->student->id]);
                $assignment->teacher_id = $this->teacher->id;
                $assignment->due_at = $this->dueDate($spec['week']);
                $assignment->save();
            }

            $this->counts['tests']++;
            $this->counts['questions'] += count($spec['questions']);
        });
    }

    /**
     * The figure for a picture file in the course directory, written once
     * per file per course and updated in place on a re-run (slug
     * `<course slug>-fig-<path>`), owned by the course's teacher.
     */
    private function figure(string $path): Figure
    {
        $file = Course::figureFile($this->course->dir, $path);
        $slug = Str::limit($this->course->slug.'-fig-'.Str::slug(str_replace('/', '-', $path)), 160, '');

        return $this->figureCache[$slug] ??= FigureWriter::seed(
            $this->teacher, $slug, (string) file_get_contents($file), Course::figureMime($path),
        );
    }

    /**
     * The standard codes a seeded item carries when the course's topic codes
     * are standards: unique, in order of first use, capped like a teacher's.
     *
     * @param  list<string>  $codes
     * @return list<string>|null
     */
    private function standards(array $codes): ?array
    {
        if (! $this->course->topicsAreStandards()) {
            return null;
        }

        return Standards::normalize(array_slice(array_values(array_unique($codes)), 0, Standards::MAX));
    }

    /** @var array<string, Figure> */
    private array $figureCache = [];

    /** @param  array<string, mixed>  $spec */
    private function material(array $spec): void
    {
        $attrs = [
            'title' => $spec['title'],
            'description' => $spec['description'],
            'subject' => $this->course->config['subject'],
            'grade_level' => $this->course->config['grade_level'],
        ] + ($this->course->topicsAreStandards() ? ['standards' => $spec['standards'] ?? null] : []);

        $material = Material::where('slug', $spec['slug'])->first();
        if ($material) {
            // A re-run with a different owner moves the file's row to them;
            // the stored path is opaque and stays where it is.
            $material->forceFill(['user_id' => $this->teacher->id])
                ->fill($attrs + ['visibility' => Visibility::Public, 'published_at' => $material->published_at ?? now()])
                ->save();
            $material->unsetRelation('author');
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

    /**
     * The demo teacher owns the base course and this one: together more files
     * than the default per-teacher cap (AP Calculus AB and BC: about 100).
     * For a demo run only, and only while no admin has set a cap, raise the
     * server default for this process to fit them. A named --teacher is held
     * to the real cap (raise it at /admin/site).
     *
     * @param  list<array<string, mixed>>  $materials  this course's and its base's
     */
    private function fitDemoQuota(array $materials): void
    {
        if ($this->course->base === null || SiteSetting::query()->find(1)?->max_materials_per_teacher !== null) {
            return;
        }
        $others = Material::where('user_id', $this->teacher->id)
            ->where(fn ($q) => $q->whereNull('slug')->orWhereNotIn('slug', array_column($materials, 'slug')))
            ->count();
        $needed = $others + count($materials);
        if ($needed > MaterialQuota::maxFiles()) {
            config(['materials.max_files_per_teacher' => $needed]);
        }
    }

    /** The base course (`builds_on`) for this course's teacher, without a student. */
    private function baseSeeder(): CurriculumSeeder
    {
        $base = new class($this->course->base->dir, $this->teacherEmail ?? $this->course->config['teacher']['email'], null, false) extends CurriculumSeeder
        {
            public static function defaultDir(): string
            {
                throw new RuntimeException('A base course is always seeded from its own directory.');
            }
        };
        if ($this->command !== null) {
            $base->setCommand($this->command);
        }
        $base->setContainer($this->container ?? app());

        return $base;
    }

    /** The materials a run would write, validated, without writing anything. */
    public function plannedMaterials(): array
    {
        $this->course = new Course($this->dir ?? static::defaultDir());

        return $this->plan()['materials'];
    }

    /**
     * Seeding this course reseeds its base for the same teacher, which moves
     * the base's rows. That is only allowed when they are unowned, already the
     * teacher's, or move together with this course (both owned by this
     * course's current owner): never take a base course from someone else.
     */
    private function assertBaseOwner(): void
    {
        $prefix = $this->course->base->slug.'-';
        $pairOwner = CourseRow::where('slug', $this->course->slug)->value('user_id');
        $owners = collect([
            ...Test::where('slug', 'like', $prefix.'%')->distinct()->pluck('user_id'),
            ...Material::where('slug', 'like', $prefix.'%')->distinct()->pluck('user_id'),
            ...CourseRow::where('slug', $this->course->base->slug)->pluck('user_id'),
        ])->unique()->reject(fn ($id) => $id === $this->teacher->id || ($pairOwner !== null && $id === $pairOwner));

        if ($owners->isNotEmpty()) {
            $emails = User::whereIn('id', $owners)->pluck('email')->implode(', ');
            throw new RuntimeException(sprintf(
                '%s builds on %s, which %s owns. Seed %s for %s first (or seed this course for its owner); nothing was written.',
                $this->course->prefix, $this->course->base->prefix, $emails, $this->course->base->prefix, $this->teacher->email,
            ));
        }
    }

    /**
     * The demo or named student gets the reused tests too, due on this
     * course's calendar.
     *
     * @param  list<array<string, mixed>>  $reused
     */
    private function assignReused(array $reused): void
    {
        if ($this->student === null) {
            return;
        }
        foreach ($reused as $e) {
            if ($e['kind'] !== 'test') {
                continue;
            }
            $test = Test::where('slug', $e['slug'])->where('user_id', $this->teacher->id)->first();
            if ($test === null) {
                continue; // course() names what is missing
            }
            $assignment = Assignment::firstOrNew(['test_id' => $test->id, 'student_id' => $this->student->id]);
            $assignment->teacher_id = $this->teacher->id;
            $assignment->due_at = $this->dueDate($e['week']);
            $assignment->save();
        }
    }

    /**
     * The course row: every seeded test and material in teaching order --
     * by week, and within a week guide, flashcards, quiz, then the unit's
     * summary and exam -- under one heading per unit. Created PRIVATE:
     * publishing a course exposes its answers in practice mode, which is the
     * owner's call, not the seeder's. A re-run moves it with everything else
     * to the current owner, keeps the visibility the owner has chosen since,
     * and rewrites the item list from the YAML.
     *
     * @param  array{tests: list<array<string, mixed>>, materials: list<array<string, mixed>>, reused: list<array<string, mixed>>}  $plan
     */
    private function course(array $plan): CourseRow
    {
        $entries = [
            ...array_map(fn ($spec) => ['kind' => 'test'] + $spec, $plan['tests']),
            ...array_map(fn ($spec) => ['kind' => 'material'] + $spec, $plan['materials']),
            ...$plan['reused'],
        ];
        // By week; within a week each reused base week in list order, then this
        // course's own rows (a reuse week has none), then a reused unit's summary and exam.
        usort($entries, fn ($a, $b) => [$a['week'], $a['sub'] ?? 0, $a['rank']] <=> [$b['week'], $b['sub'] ?? 0, $b['rank']]);

        $slugs = fn (string $kind) => array_column(array_filter($entries, fn ($e) => $e['kind'] === $kind), 'slug');
        $ids = [
            'test' => Test::whereIn('slug', $slugs('test'))->where('user_id', $this->teacher->id)->pluck('id', 'slug'),
            'material' => Material::whereIn('slug', $slugs('material'))->where('user_id', $this->teacher->id)->pluck('id', 'slug'),
        ];
        foreach ($entries as $e) {
            if (! isset($ids[$e['kind']][$e['slug']])) {
                throw new RuntimeException("The course needs {$e['kind']} {$e['slug']}, which {$this->teacher->email} does not own.");
            }
        }
        $items = array_map(fn ($e) => [
            'kind' => $e['kind'],
            'id' => $ids[$e['kind']][$e['slug']],
            'section' => $e['section'],
        ], $entries);

        return DB::transaction(function () use ($items) {
            $config = $this->course->config;
            $course = CourseRow::firstOrNew(['slug' => $this->course->slug]);
            $course->user_id = $this->teacher->id;
            $course->title = (string) ($config['title'] ?? $this->course->prefix);
            $course->description = isset($config['description']) ? trim((string) $config['description']) : null;
            $course->subject = $config['subject'];
            $course->grade_level = $config['grade_level'];
            $course->visibility ??= Visibility::Private;
            $course->save();

            CourseWriter::syncItems($course, $items);
            $this->claimSiteSlug($course, $config['site_slug'] ?? null);

            return $course->fresh();
        });
    }

    /**
     * `site_slug` in course.yaml: the course's /courses/<slug> address, set
     * only while the course has none and the address was never used
     * (Slugs never reissues one). A slug an admin changed since stays theirs.
     */
    private function claimSiteSlug(CourseRow $course, mixed $slug): void
    {
        if (! is_string($slug) || Slugs::problem($slug) !== null) {
            return;
        }
        $taken = UrlSlug::where('kind', SlugKind::SiteCourse)
            ->where(fn ($q) => $q->where('course_id', $course->id)->orWhere('slug', $slug))->exists();
        if (! $taken) {
            UrlSlug::create(['kind' => SlugKind::SiteCourse, 'scope_id' => 0, 'slug' => $slug, 'course_id' => $course->id, 'status' => SlugStatus::Approved, 'reviewed_at' => now()]);
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

    /** A test or material slug, namespaced by the course: `apbio-w07-quiz`. */
    private function slug(string $suffix): string
    {
        return "{$this->course->slug}-{$suffix}";
    }

    private function read(string $path): string
    {
        if (! is_file($path)) {
            throw new RuntimeException("Missing file: {$path}");
        }

        return (string) file_get_contents($path);
    }
}
