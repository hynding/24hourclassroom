<?php

use App\Enums\Role;
use App\Models\Connection;
use App\Models\MaterialShare;
use App\Models\User;
use App\Notifications\MaterialShared;
use Illuminate\Support\Facades\Storage;

beforeEach(function () {
    $this->withHeader('Referer', 'http://localhost:3333');
    $this->withHeader('Accept', 'application/json');
    Storage::fake(config('materials.disk'));
});

test('sharing reports per id: connected teachers and students are shared, everything else is not_found', function () {
    $author = aTeacher();
    $material = aMaterial($author);

    $student = aStudent();
    connectAccepted($author, $student);
    $teacher = aTeacher();
    connectAccepted($author, $teacher);

    $pending = aStudent();
    Connection::create([
        'requester_id' => $author->id, 'addressee_id' => $pending->id,
        'status' => 'pending', 'pair_key' => Connection::pairKey($author->id, $pending->id),
    ]);
    $stranger = aStudent();
    $deactivated = aStudent();
    connectAccepted($author, $deactivated);
    $deactivated->forceFill(['deactivated_at' => now()])->save();

    $this->actingAs($author);

    $ids = [$student->id, $teacher->id, $pending->id, $stranger->id, $deactivated->id, $author->id, 999999];
    $results = $this->postJson("/api/materials/{$material->id}/shares", ['user_ids' => $ids])
        ->assertOk()->json('results');

    expect($results)->toBe([
        ['id' => $student->id, 'status' => 'shared'],
        ['id' => $teacher->id, 'status' => 'shared'],
        ['id' => $pending->id, 'status' => 'not_found'],
        ['id' => $stranger->id, 'status' => 'not_found'],
        ['id' => $deactivated->id, 'status' => 'not_found'],
        ['id' => $author->id, 'status' => 'not_found'],
        ['id' => 999999, 'status' => 'not_found'],
    ]);

    expect(MaterialShare::count())->toBe(2)
        ->and($student->notifications()->count())->toBe(1)
        ->and($student->notifications()->first()->type)->toBe(MaterialShared::class)
        ->and($student->notifications()->first()->data['material_id'])->toBe($material->id)
        ->and($student->notifications()->first()->data['material_title'])->toBe($material->title)
        ->and($student->notifications()->first()->data['user']['id'])->toBe($author->id)
        ->and($student->notifications()->first()->data['user']['role'])->toBe('teacher');
});

test('every role that is not teacher or student is not_found, even when connected', function () {
    $author = aTeacher();
    $material = aMaterial($author);
    $this->actingAs($author);

    foreach (Role::cases() as $role) {
        if (in_array($role, [Role::Teacher, Role::Student], true)) {
            continue;
        }
        $target = User::factory()->create(['role' => $role->value]);
        connectAccepted($author, $target);

        $this->postJson("/api/materials/{$material->id}/shares", ['user_ids' => [$target->id]])
            ->assertOk()->assertJsonPath('results.0.status', 'not_found');
    }

    expect(MaterialShare::count())->toBe(0);
});

test('sharing the same id twice is idempotent and notifies once', function () {
    $author = aTeacher();
    $material = aMaterial($author);
    $student = aStudent();
    connectAccepted($author, $student);
    $this->actingAs($author);

    $this->postJson("/api/materials/{$material->id}/shares", ['user_ids' => [$student->id, $student->id]])
        ->assertOk()->assertJsonPath('results.0.status', 'shared')->assertJsonPath('results.1.status', 'shared');
    $this->postJson("/api/materials/{$material->id}/shares", ['user_ids' => [$student->id]])
        ->assertOk()->assertJsonPath('results.0.status', 'shared');

    expect(MaterialShare::count())->toBe(1)->and($student->notifications()->count())->toBe(1);
});

test('the share list shows only currently connected, active recipients', function () {
    $author = aTeacher();
    $material = aMaterial($author);
    $student = aStudent();
    $connection = connectAccepted($author, $student);
    shareWith($material, $student);
    $gone = aStudent();
    connectAccepted($author, $gone);
    shareWith($material, $gone);
    $gone->forceFill(['deactivated_at' => now()])->save();
    $this->actingAs($author);

    $rows = $this->getJson("/api/materials/{$material->id}/shares")->assertOk()->json('data');
    expect($rows)->toHaveCount(1)
        ->and($rows[0]['user']['id'])->toBe($student->id)
        ->and($rows[0]['user']['name'])->toBe($student->name)
        ->and($rows[0]['user']['role'])->toBe('student')
        ->and(array_keys($rows[0]))->toBe(['id', 'user', 'created_at']);

    // Disconnecting hides the recipient; reconnecting brings them back with
    // no re-share, because the row was never deleted.
    $connection->delete();
    expect($this->getJson("/api/materials/{$material->id}/shares")->assertOk()->json('data'))->toBe([]);

    connectAccepted($author, $student);
    expect($this->getJson("/api/materials/{$material->id}/shares")->assertOk()->json('data'))->toHaveCount(1);
});

test('unsharing is 204, and a share id from another material is 404', function () {
    $author = aTeacher();
    $material = aMaterial($author);
    $other = aMaterial($author);
    $student = aStudent();
    connectAccepted($author, $student);
    $share = shareWith($material, $student);
    $foreign = shareWith($other, $student);
    $this->actingAs($author);

    $this->deleteJson("/api/materials/{$material->id}/shares/{$foreign->id}")->assertStatus(404);
    $this->deleteJson("/api/materials/{$material->id}/shares/{$share->id}")->assertNoContent();

    expect(MaterialShare::find($share->id))->toBeNull()
        ->and(MaterialShare::find($foreign->id))->not->toBeNull();

    // The recipient loses access immediately.
    $this->actingAs($student);
    $this->getJson("/api/materials/{$material->id}")->assertStatus(404);
});

test('only the author manages shares: 404 on private, 403 on public', function () {
    $author = aTeacher();
    $private = aMaterial($author);
    $public = aMaterial($author, ['visibility' => 'public', 'published_at' => now()]);
    $share = shareWith($public, aStudent());

    foreach (Role::cases() as $role) {
        $this->actingAs(User::factory()->create(['role' => $role->value]));

        $this->getJson("/api/materials/{$private->id}/shares")->assertStatus(404);
        $this->postJson("/api/materials/{$private->id}/shares", ['user_ids' => [1]])->assertStatus(404);
        $this->getJson("/api/materials/{$public->id}/shares")->assertStatus(403);
        $this->deleteJson("/api/materials/{$public->id}/shares/{$share->id}")->assertStatus(403);
    }

    expect(MaterialShare::count())->toBe(1);
});

test('the share list body is validated', function () {
    $author = aTeacher();
    $material = aMaterial($author);
    $this->actingAs($author);

    $this->postJson("/api/materials/{$material->id}/shares", [])->assertStatus(422)->assertJsonValidationErrors('user_ids');
    $this->postJson("/api/materials/{$material->id}/shares", ['user_ids' => []])->assertStatus(422)->assertJsonValidationErrors('user_ids');
    $this->postJson("/api/materials/{$material->id}/shares", ['user_ids' => range(1, 101)])->assertStatus(422)->assertJsonValidationErrors('user_ids');
    $this->postJson("/api/materials/{$material->id}/shares", ['user_ids' => ['abc']])->assertStatus(422)->assertJsonValidationErrors('user_ids.0');
});
