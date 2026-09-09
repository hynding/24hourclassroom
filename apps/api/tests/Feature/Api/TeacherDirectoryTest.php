<?php

use App\Models\Profile;
use App\Models\User;

test('the directory lists teachers and excludes students', function () {
    $teacher = User::factory()->create(['role' => 'teacher', 'name' => 'Ada Teacher']);
    Profile::factory()->for($teacher)->create(['school' => 'Rivet High']);
    User::factory()->create(['role' => 'student', 'name' => 'Sam Student']);

    $this->getJson('/api/teachers')
        ->assertOk()
        ->assertJsonCount(1, 'data')
        ->assertJsonPath('data.0.name', 'Ada Teacher')
        ->assertJsonPath('data.0.school', 'Rivet High');
});

test('a teacher with no profile row is still listed and still matches a name search', function () {
    User::factory()->create(['role' => 'teacher', 'name' => 'Blank Slate']);

    $this->getJson('/api/teachers')->assertOk()->assertJsonCount(1, 'data')
        ->assertJsonPath('data.0.school', null)
        ->assertJsonPath('data.0.subjects', [])
        ->assertJsonPath('data.0.grade_levels', [])
        ->assertJsonPath('data.0.avatar_url', null);

    $this->getJson('/api/teachers?q=Blank')->assertOk()->assertJsonCount(1, 'data');
});

test('subject and grade filters narrow the list', function () {
    $mathTeacher = User::factory()->create(['role' => 'teacher']);
    Profile::factory()->for($mathTeacher)->create(['subjects' => ['math'], 'grade_levels' => ['9-12']]);
    $artTeacher = User::factory()->create(['role' => 'teacher']);
    Profile::factory()->for($artTeacher)->create(['subjects' => ['art'], 'grade_levels' => ['k-2']]);

    $this->getJson('/api/teachers?subject=math')->assertJsonCount(1, 'data')
        ->assertJsonPath('data.0.id', $mathTeacher->id);

    $this->getJson('/api/teachers?grade=k-2')->assertJsonCount(1, 'data')
        ->assertJsonPath('data.0.id', $artTeacher->id);
});

test('q matches on name or school', function () {
    $byName = User::factory()->create(['role' => 'teacher', 'name' => 'Grace Hopper']);
    Profile::factory()->for($byName)->create(['school' => 'Nowhere']);
    $bySchool = User::factory()->create(['role' => 'teacher', 'name' => 'Someone Else']);
    Profile::factory()->for($bySchool)->create(['school' => 'Hopper Academy']);
    $nonMatching = User::factory()->create(['role' => 'teacher', 'name' => 'Totally Different']);
    Profile::factory()->for($nonMatching)->create(['school' => 'Elsewhere']);
    User::factory()->create(['role' => 'student', 'name' => 'Hopper Student']);

    $response = $this->getJson('/api/teachers?q=Hopper')->assertOk()->assertJsonCount(2, 'data');

    expect(collect($response->json('data'))->pluck('id')->all())
        ->toEqualCanonicalizing([$byName->id, $bySchool->id]);
});

test('a literal percent in q is escaped and does not match every teacher', function () {
    User::factory()->create(['role' => 'teacher', 'name' => 'Alice']);
    User::factory()->create(['role' => 'teacher', 'name' => 'Bob']);

    $this->getJson('/api/teachers?'.http_build_query(['q' => '%']))
        ->assertOk()
        ->assertJsonCount(0, 'data');
});

test('an unknown subject is a validation error, not a silent empty list', function () {
    $this->getJson('/api/teachers?subject=wizardry')
        ->assertStatus(422)
        ->assertJsonValidationErrors('subject');
});

test('results are paginated 15 to a page', function () {
    User::factory()->count(16)->create(['role' => 'teacher']);

    $this->getJson('/api/teachers')
        ->assertOk()
        ->assertJsonCount(15, 'data')
        ->assertJsonPath('meta.total', 16)
        ->assertJsonPath('meta.last_page', 2);
});

test('the directory is public', function () {
    User::factory()->create(['role' => 'teacher']);

    $this->getJson('/api/teachers')->assertOk();
});

test('the public directory is rate limited', function () {
    // /api/* has no global throttle - bootstrap/app.php never calls throttleApi() -
    // so this asserts the route brings its own.
    foreach (range(1, 60) as $ignored) {
        $this->getJson('/api/teachers')->assertOk();
    }

    $this->getJson('/api/teachers')->assertStatus(429);
});
