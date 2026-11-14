<?php

use App\Models\Connection;
use App\Models\User;
use App\Notifications\ConnectionRequested;
use Illuminate\Support\Facades\Notification;

beforeEach(function () {
    $this->withHeader('Referer', 'http://localhost:3333');
});

function withRole(string $role, array $attrs = []): User
{
    return User::factory()->create(['role' => $role, ...$attrs]);
}

test('a code is minted on first read, then stable, and never serialized with the user', function () {
    $guardian = withRole('guardian');
    $this->actingAs($guardian);

    $code = $this->getJson('/api/connections/code')->assertOk()->json('code');

    expect($code)->toMatch('/^[A-HJ-NP-Z2-9]{10}$/')
        ->and($this->getJson('/api/connections/code')->json('code'))->toBe($code)
        ->and($guardian->fresh()->toArray())->not->toHaveKey('connect_code');
    $this->getJson('/api/user')->assertOk()->assertJsonMissingPath('connect_code');
});

test('a student connects with a guardian by code, and the guardian accepts', function () {
    Notification::fake();
    $guardian = withRole('guardian');
    $student = withRole('student');

    $this->actingAs($guardian);
    $code = $this->getJson('/api/connections/code')->json('code');

    $this->actingAs($student);
    // Case-insensitive: codes get read aloud and typed on phones.
    $this->postJson('/api/connections/code/'.strtolower($code))->assertNoContent();

    $connection = Connection::firstOrFail();
    expect($connection->requester_id)->toBe($student->id)
        ->and($connection->addressee_id)->toBe($guardian->id);
    Notification::assertSentTo($guardian, ConnectionRequested::class);

    $this->actingAs($guardian);
    $this->patchJson("/api/connections/{$connection->id}")->assertNoContent();
    expect(Connection::acceptedBetween($guardian, $student))->toBeTrue();
});

test('rotating a code retires the old one', function () {
    $assistant = withRole('assistant');
    $this->actingAs($assistant);
    $old = $this->getJson('/api/connections/code')->json('code');
    $new = $this->putJson('/api/connections/code')->assertOk()->json('code');

    expect($new)->not->toBe($old);

    $this->actingAs(withRole('teacher'));
    $this->postJson("/api/connections/code/{$old}")->assertNotFound();
    $this->postJson("/api/connections/code/{$new}")->assertNoContent();
});

test('every miss is the same 404 and writes nothing', function () {
    config(['app.debug' => false]);
    $guardian = withRole('guardian', ['connect_code' => 'GGGGGGGGGG']);
    $otherGuardian = withRole('guardian', ['connect_code' => 'HHHHHHHHHH']);
    $assistant = withRole('assistant', ['connect_code' => 'AAAAAAAAAA']);
    withRole('admin', ['connect_code' => 'MMMMMMMMMM']);
    withRole('student', ['connect_code' => 'DDDDDDDDDD', 'deactivated_at' => now()]);

    $this->actingAs($guardian);
    $missing = $this->postJson('/api/connections/code/ZZZZZZZZZZ');
    expect($missing->status())->toBe(404);

    // Guardian <-> guardian, guardian <-> assistant, anyone <-> admin, and a
    // deactivated owner: all indistinguishable from a code nobody holds.
    foreach (['HHHHHHHHHH', 'AAAAAAAAAA', 'MMMMMMMMMM', 'DDDDDDDDDD'] as $code) {
        $probe = $this->postJson("/api/connections/code/{$code}");
        expect($probe->status())->toBe(404)->and($probe->json())->toBe($missing->json());
    }

    $this->actingAs($assistant);
    $this->postJson('/api/connections/code/GGGGGGGGGG')->assertNotFound();

    expect(Connection::count())->toBe(0)
        ->and($otherGuardian->notifications()->count())->toBe(0);
});

test('your own code is refused, and a second request says it already exists', function () {
    $tutor = withRole('tutor', ['connect_code' => 'TTTTTTTTTT']);
    $this->actingAs($tutor);
    $this->postJson('/api/connections/code/TTTTTTTTTT')->assertStatus(422)->assertJsonValidationErrors('user');

    $this->actingAs(withRole('student'));
    $this->postJson('/api/connections/code/TTTTTTTTTT')->assertNoContent();
    $this->postJson('/api/connections/code/TTTTTTTTTT')->assertStatus(422)->assertJsonValidationErrors('user');
});
