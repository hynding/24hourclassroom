<?php

beforeEach(function () {
    $this->withHeader('Referer', 'http://localhost:3333');
});

test('the library lists public tests by active authors with filters', function () {
    $a = aTeacher();
    $math = aTestWithQuestions($a, 1, ['visibility' => 'public', 'published_at' => now()->subDay(), 'subject' => 'math', 'grade_level' => '3-5', 'title' => 'Fractions']);
    $sci = aTestWithQuestions($a, 1, ['visibility' => 'public', 'published_at' => now(), 'subject' => 'science', 'grade_level' => '6-8', 'title' => 'Cells']);
    aTestWithQuestions($a, 1); // private
    $gone = aTeacher();
    aTestWithQuestions($gone, 1, ['visibility' => 'public', 'published_at' => now()]);
    $gone->forceFill(['deactivated_at' => now()])->save();

    $this->getJson('/api/library')->assertOk()->assertJsonCount(2, 'data')
        ->assertJsonPath('data.0.id', $sci->id)
        ->assertJsonPath('data.0.author.name', $a->name)
        ->assertJsonPath('data.0.question_count', 1);
    $this->getJson('/api/library?subject=math')->assertJsonCount(1, 'data')->assertJsonPath('data.0.id', $math->id);
    $this->getJson('/api/library?grade=6-8')->assertJsonCount(1, 'data')->assertJsonPath('data.0.id', $sci->id);
    $this->getJson('/api/library?q=frac')->assertJsonCount(1, 'data');
    $this->getJson('/api/library?q=%25')->assertJsonCount(0, 'data');
    $this->getJson('/api/library?subject=nope')->assertStatus(422);
});
