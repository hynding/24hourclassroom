<?php

beforeEach(function () {
    $this->withHeader('Referer', 'http://localhost:3333');
});

test('publishing needs at least one live question and is idempotent', function () {
    $author = aTeacher();
    $empty = aTestWithQuestions($author, 0);
    $this->actingAs($author);

    $this->postJson("/api/tests/{$empty->id}/publish")->assertStatus(422);

    $test = aTestWithQuestions($author, 1);
    $this->postJson("/api/tests/{$test->id}/publish")->assertOk()->assertJsonPath('visibility', 'public');
    $first = $test->fresh()->published_at;
    $this->postJson("/api/tests/{$test->id}/publish")->assertOk();
    expect($test->fresh()->published_at->equalTo($first))->toBeTrue();

    $this->postJson("/api/tests/{$test->id}/unpublish")->assertOk()->assertJsonPath('visibility', 'private');
    $this->postJson("/api/tests/{$test->id}/unpublish")->assertOk();
});

test('a non-author cannot publish: 404 private, 403 public', function () {
    $author = aTeacher();
    $private = aTestWithQuestions($author, 1);
    $public = aTestWithQuestions($author, 1, ['visibility' => 'public', 'published_at' => now()]);
    $this->actingAs(aTeacher());

    $this->postJson("/api/tests/{$private->id}/publish")->assertStatus(404);
    $this->postJson("/api/tests/{$public->id}/unpublish")->assertStatus(403);
});
