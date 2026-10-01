<?php

use App\Enums\GenerationStatus;
use App\Models\Generation;

test('hasLeftovers is true only for a terminal row with undeleted files or an unarchived session', function () {
    $owner = aTeacher();
    $expected = [];

    foreach (GenerationStatus::cases() as $status) {
        $terminal = $status->isTerminal();

        $files = Generation::factory()->for($owner)->create([
            'status' => $status->value, 'session_id' => null, 'file_ids' => ['file_1'], 'archived_at' => now(),
        ]);
        $session = Generation::factory()->for($owner)->create([
            'status' => $status->value, 'session_id' => 'sesn_1', 'file_ids' => null, 'archived_at' => null,
        ]);
        $clean = Generation::factory()->for($owner)->create([
            'status' => $status->value, 'session_id' => 'sesn_2', 'file_ids' => null, 'archived_at' => now(),
        ]);
        $none = Generation::factory()->for($owner)->create([
            'status' => $status->value, 'session_id' => null, 'file_ids' => null, 'archived_at' => null,
        ]);

        // A live run has a session and no archived_at by construction: that is
        // a run in progress, not a leftover. Only a FINISHED row can have one.
        expect($files->fresh()->hasLeftovers())->toBe($terminal, "files, {$status->value}")
            ->and($session->fresh()->hasLeftovers())->toBe($terminal, "session, {$status->value}")
            ->and($clean->fresh()->hasLeftovers())->toBeFalse("clean, {$status->value}")
            ->and($none->fresh()->hasLeftovers())->toBeFalse("none, {$status->value}");

        if ($terminal) {
            $expected[] = $files->id;
            $expected[] = $session->id;
        }
    }

    // The scope is the same predicate in SQL: exactly the rows the method says yes to.
    expect(Generation::withLeftovers()->orderBy('id')->pluck('id')->all())->toBe($expected);
});
