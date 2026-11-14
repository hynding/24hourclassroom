<?php

namespace App\Console\Commands;

use Database\Seeders\Curriculum\CurriculumSeeder;
use Illuminate\Console\Command;
use Illuminate\Console\ConfirmableTrait;
use RuntimeException;

/**
 * Seed (or re-seed in place) one seeded course, owned by an account of your
 * choosing. Each course's command names its seeder and its signature; the
 * options are the same for all of them:
 *
 *   {--teacher=} {--student=} {--no-student} {--force}
 *
 * `db:seed --class=<Seeder>` still works and uses the demo accounts from
 * the course's course.yaml.
 */
abstract class SeedCurriculum extends Command
{
    use ConfirmableTrait;

    protected const OPTIONS = '
        {--teacher= : Email of an existing, verified teacher who will own the course (default: the demo teacher)}
        {--student= : Email of an existing student to assign every test to (default: the demo student)}
        {--no-student : Create no student, no connection and no assignments}
        {--force : Run in production without asking}';

    /** @return class-string<CurriculumSeeder> */
    abstract protected function seeder(): string;

    public function handle(): int
    {
        if ($this->option('student') && $this->option('no-student')) {
            $this->error('Pass --student or --no-student, not both.');

            return self::FAILURE;
        }

        if (! $this->confirmToProceed()) {
            return self::FAILURE;
        }

        // From the container so tests can point it at the fixture course.
        $seeder = $this->laravel->make($this->seeder(), [
            'teacherEmail' => $this->option('teacher') ?: null,
            'studentEmail' => $this->option('student') ?: null,
            'withStudent' => ! $this->option('no-student'),
        ]);

        try {
            $seeder->setContainer($this->laravel)->setCommand($this)->__invoke();
        } catch (RuntimeException $e) {
            $this->error($e->getMessage());

            return self::FAILURE;
        }

        return self::SUCCESS;
    }
}
