<?php

use App\Enums\Role;
use App\Models\Test;
use App\Models\User;

beforeEach(function () {
    $this->withHeader('Referer', 'http://localhost:3333');
});

test('a teacher copies a public test as a private draft with live questions only', function () {
    $author = aTeacher();
    $source = aTestWithQuestions($author, 3, ['visibility' => 'public', 'published_at' => now()]);
    $source->questions->last()->delete();
    $me = aTeacher();
    $this->actingAs($me);

    $res = $this->postJson("/api/tests/{$source->id}/copy")->assertCreated()
        ->assertJsonPath('visibility', 'private')
        ->assertJsonPath('copied_from_id', $source->id)
        ->assertJsonPath('author.id', $me->id)
        ->assertJsonPath('question_count', 2)
        ->assertJsonPath('published_at', null);

    $copy = Test::find($res->json('id'));
    expect($copy->questions->pluck('prompt')->all())->toBe($source->fresh()->questions->pluck('prompt')->all());

    $source->delete();
    expect($copy->fresh()->copied_from_id)->toBeNull();
});

test('copy is 404 on a private source, including the authors own', function () {
    $author = aTeacher();
    $private = aTestWithQuestions($author, 1);
    $this->actingAs(aTeacher());
    $this->postJson("/api/tests/{$private->id}/copy")->assertStatus(404);
    $this->actingAs($author);
    $this->postJson("/api/tests/{$private->id}/copy")->assertStatus(404);
});

test('the author cannot copy their own public test', function () {
    $author = aTeacher();
    $test = aTestWithQuestions($author, 1, ['visibility' => 'public', 'published_at' => now()]);
    $this->actingAs($author);

    $this->postJson("/api/tests/{$test->id}/copy")->assertStatus(403);
    $this->getJson("/api/tests/{$test->id}")->assertOk()->assertJsonPath('can_copy', false);
});

test('every non-teacher role gets 403 on a public source', function () {
    $source = aTestWithQuestions(aTeacher(), 1, ['visibility' => 'public', 'published_at' => now()]);
    foreach (Role::cases() as $role) {
        if ($role === Role::Teacher) {
            continue;
        }
        $this->actingAs(User::factory()->create(['role' => $role->value]));
        $this->postJson("/api/tests/{$source->id}/copy")->assertStatus(403);
    }
});

test('a copy carries stimulus, rationales and auto_grade but never the seed slug', function () {
    $author = aTeacher();
    $source = aTestWithQuestions($author, 0, ['visibility' => 'public', 'published_at' => now(), 'slug' => 'apbio-w01-quiz']);
    \App\Models\Question::factory()->for($source)->create([
        'position' => 0, 'slug' => 'u01-w01-q01', 'stimulus' => 'Shared passage.',
        'option_explanations' => ['Right.', 'Wrong.', 'Wrong.', 'Wrong.'],
    ]);
    \App\Models\Question::factory()->for($source)->fillBlank(['polar'], false)->create(['position' => 1, 'slug' => 'u01-w01-q02']);
    $this->actingAs(aTeacher());

    $res = $this->postJson("/api/tests/{$source->id}/copy")->assertCreated()
        ->assertJsonPath('questions.0.stimulus', 'Shared passage.')
        ->assertJsonPath('questions.0.option_explanations.0', 'Right.')
        ->assertJsonPath('questions.1.auto_grade', false);

    $copy = Test::find($res->json('id'));
    expect($copy->slug)->toBeNull()
        ->and($copy->questions->pluck('slug')->all())->toBe([null, null]);
});
