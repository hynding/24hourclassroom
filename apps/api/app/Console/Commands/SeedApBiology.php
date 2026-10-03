<?php

namespace App\Console\Commands;

use Database\Seeders\ApBiologySeeder;
use Illuminate\Console\Command;
use Illuminate\Console\ConfirmableTrait;
use RuntimeException;

/**
 * Seed (or re-seed in place) the AP Biology course, owned by an account of
 * your choosing. `db:seed --class=ApBiologySeeder` still works and uses the
 * demo accounts from course.yaml.
 */
class SeedApBiology extends Command
{
    use ConfirmableTrait;

    protected $signature = 'course:seed-ap-biology
        {--teacher= : Email of an existing, verified teacher who will own the course (default: the demo teacher)}
        {--student= : Email of an existing student to assign every test to (default: the demo student)}
        {--no-student : Create no student, no connection and no assignments}
        {--force : Run in production without asking}';

    protected $description = 'Seed the AP Biology course, owned by an existing teacher or by the demo account';

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
        $seeder = $this->laravel->make(ApBiologySeeder::class, [
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
