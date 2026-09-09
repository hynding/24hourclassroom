<?php

use App\Enums\GradeLevel;
use App\Enums\Subject;
use App\Models\Profile;
use App\Models\User;

beforeEach(function () {
    $this->withHeader('Referer', 'http://localhost:3333');
});

test('a user with no profile row reads an empty profile', function () {
    $this->actingAs(User::factory()->create());

    $this->getJson('/api/profile')
        ->assertOk()
        ->assertExactJson([
            'bio' => null,
            'school' => null,
            'specialties' => null,
            'subjects' => [],
            'grade_levels' => [],
            'avatar_url' => null,
        ]);
});

test('put lazily creates the profile row', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $this->putJson('/api/profile', [
        'bio' => 'I teach math.',
        'school' => 'Rivet High',
        'specialties' => 'Robotics club',
        'subjects' => ['math', 'computer-science'],
        'grade_levels' => ['9-12'],
    ])->assertOk()->assertJsonPath('school', 'Rivet High');

    $this->assertDatabaseHas('profiles', ['user_id' => $user->id, 'school' => 'Rivet High']);
    expect($user->fresh()->profile->subjects)->toBe(['math', 'computer-science']);
});

test('put updates an existing profile without creating a second row', function () {
    $user = User::factory()->create();
    Profile::factory()->for($user)->create([
        'school' => 'Old',
        'subjects' => ['math'],
        'grade_levels' => ['9-12'],
    ]);
    $this->actingAs($user);

    $this->putJson('/api/profile', ['school' => 'New'])->assertOk();

    expect(Profile::where('user_id', $user->id)->count())->toBe(1)
        ->and($user->fresh()->profile->school)->toBe('New')
        ->and($user->fresh()->profile->subjects)->toBe(['math'])
        ->and($user->fresh()->profile->grade_levels)->toBe(['9-12']);
});

test('put with an explicit null wipes the field instead of leaving it untouched', function () {
    $user = User::factory()->create();
    Profile::factory()->for($user)->create(['school' => 'Old']);
    $this->actingAs($user);

    $this->putJson('/api/profile', ['school' => null])->assertOk();

    expect($user->fresh()->profile->school)->toBeNull();
});

test('put accepts every Subject and every GradeLevel case', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $subjects = array_column(Subject::cases(), 'value');
    $gradeLevels = array_column(GradeLevel::cases(), 'value');

    // Guard against an empty enum silently making this test vacuous.
    expect($subjects)->not->toBeEmpty()
        ->and($gradeLevels)->not->toBeEmpty();

    $this->putJson('/api/profile', [
        'subjects' => $subjects,
        'grade_levels' => $gradeLevels,
    ])->assertOk()
        ->assertJsonPath('subjects', $subjects)
        ->assertJsonPath('grade_levels', $gradeLevels);

    expect($user->fresh()->profile->subjects)->toBe($subjects)
        ->and($user->fresh()->profile->grade_levels)->toBe($gradeLevels);
});

test('put rejects values outside the curated taxonomy', function () {
    $this->actingAs(User::factory()->create());

    $this->putJson('/api/profile', [
        'subjects' => ['underwater-basket-weaving'],
        'grade_levels' => ['phd'],
    ])->assertStatus(422)->assertJsonValidationErrors(['subjects.0', 'grade_levels.0']);
});

test('put rejects an over-long bio', function () {
    $this->actingAs(User::factory()->create());

    $this->putJson('/api/profile', ['bio' => str_repeat('a', 2001)])
        ->assertStatus(422)
        ->assertJsonValidationErrors('bio');
});

test('put rejects a subjects/grade_levels array longer than 20 entries', function () {
    $this->actingAs(User::factory()->create());

    $this->putJson('/api/profile', [
        'subjects' => array_fill(0, 21, 'math'),
        'grade_levels' => array_fill(0, 21, '9-12'),
    ])->assertStatus(422)->assertJsonValidationErrors(['subjects', 'grade_levels']);
});

test('put rejects duplicate values within subjects/grade_levels', function () {
    $this->actingAs(User::factory()->create());

    $this->putJson('/api/profile', [
        'subjects' => ['math', 'math'],
        'grade_levels' => ['9-12', '9-12'],
    ])->assertStatus(422)->assertJsonValidationErrors(['subjects.0', 'subjects.1', 'grade_levels.0', 'grade_levels.1']);
});

test('unverified users are blocked from the profile endpoints with 403', function () {
    $this->actingAs(User::factory()->unverified()->create());

    $this->getJson('/api/profile')->assertStatus(403);
    $this->putJson('/api/profile', ['school' => 'X'])->assertStatus(403);
});

test('unverified users can still reach /api/user', function () {
    $this->actingAs(User::factory()->unverified()->create());

    $this->getJson('/api/user')->assertOk();
});

test('guests are rejected', function () {
    $this->getJson('/api/profile')->assertStatus(401);
});
