<?php

use App\Models\Generation;
use App\Notifications\GenerationModerated;

test('GenerationModerated is an actor-less database notification carrying the title and a message', function () {
    $generation = Generation::factory()->create(['title' => 'Volcanoes']);
    $notification = new GenerationModerated($generation);

    // No `user` key, like TestModerated and MaterialModerated: the acting
    // admin is not disclosed, and NotificationController::visible() passes
    // actor-less rows straight through.
    expect($notification->via($generation->user))->toBe(['database'])
        ->and($notification->toArray($generation->user))->toBe([
            'generation_id' => $generation->id,
            'generation_title' => 'Volcanoes',
            'message' => 'An administrator cancelled the generation "Volcanoes".',
        ]);
});
