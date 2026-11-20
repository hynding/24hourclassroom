<?php

use App\Enums\GradeLevel;
use App\Models\Material;
use App\Models\Test;
use App\Support\Standards;
use Illuminate\Support\Facades\Storage;

beforeEach(function () {
    $this->withHeader('Referer', 'http://localhost:3333');
});

test('a teacher tags a test with standard codes, stored uppercase and de-duplicated', function () {
    $teacher = aTeacher();
    $body = [
        'title' => 'Fractions', 'subject' => 'math', 'grade_level' => 'grade-3',
        'standards' => [' 3.nf.a.1', '3.NF.A.1', 'K-ESS2-1'],
        'questions' => [['type' => 'true_false', 'prompt' => '1/2 > 1/3', 'answer' => true]],
    ];

    $id = $this->actingAs($teacher)->postJson('/api/tests', $body)->assertCreated()
        ->assertJsonPath('grade_level', 'grade-3')
        ->assertJsonPath('standards', ['3.NF.A.1', 'K-ESS2-1'])
        ->json('id');

    // An update that leaves the key out keeps the codes; [] clears them.
    unset($body['standards']);
    $this->actingAs($teacher)->putJson("/api/tests/{$id}", $body)->assertOk()->assertJsonPath('standards', ['3.NF.A.1', 'K-ESS2-1']);
    $this->actingAs($teacher)->putJson("/api/tests/{$id}", $body + ['standards' => []])->assertOk()->assertJsonPath('standards', []);
    expect(Test::find($id)->standards)->toBeNull();
});

test('a malformed or overlong standard list is a 422 on the offending code', function () {
    $teacher = aTeacher();
    $body = [
        'title' => 'Fractions', 'subject' => 'math', 'grade_level' => 'grade-3',
        'questions' => [['type' => 'true_false', 'prompt' => 'x', 'answer' => true]],
    ];

    $this->actingAs($teacher)->postJson('/api/tests', $body + ['standards' => ['3.NF.A.1', 'not a code!']])
        ->assertStatus(422)->assertJsonValidationErrors('standards.1');
    $this->actingAs($teacher)->postJson('/api/tests', $body + ['standards' => array_fill(0, Standards::MAX + 1, 'K.CC.A.1')])
        ->assertStatus(422)->assertJsonValidationErrors('standards');
});

test('a material carries standards through upload and update', function () {
    Storage::fake('local');
    $teacher = aTeacher();

    $id = $this->actingAs($teacher)->post('/api/materials', [
        'file' => materialFixture('sample.pdf'), 'subject' => 'math', 'grade_level' => 'grade-4',
        'standards' => ['4.nbt.b.5'],
    ], ['Accept' => 'application/json'])->assertCreated()->assertJsonPath('standards', ['4.NBT.B.5'])->json('id');

    $this->actingAs($teacher)->putJson("/api/materials/{$id}", [
        'title' => 'Multiplying', 'subject' => 'math', 'grade_level' => 'grade-4', 'standards' => ['4.NBT.B.6'],
    ])->assertOk()->assertJsonPath('standards', ['4.NBT.B.6']);
    expect(Material::find($id)->standards)->toBe(['4.NBT.B.6']);
});

test('the libraries filter by a standard code or its start at a dot or dash', function () {
    $a = aTeacher();
    $pub = ['visibility' => 'public', 'published_at' => now()];
    $nf = aTestWithQuestions($a, 1, $pub + ['standards' => ['3.NF.A.1']]);
    $ess = aTestWithQuestions($a, 1, $pub + ['standards' => ['K-ESS2-1']]);
    aTestWithQuestions($a, 1, $pub + ['standards' => ['3.NFX.A.1']]);
    aTestWithQuestions($a, 1, $pub);
    $mat = aMaterial($a, $pub + ['standards' => ['3.NF.A.2']]);

    $this->getJson('/api/library?standard=3.nf.a.1')->assertOk()->assertJsonCount(1, 'data')->assertJsonPath('data.0.id', $nf->id)
        ->assertJsonPath('data.0.standards', ['3.NF.A.1']);
    $this->getJson('/api/library?standard=3.NF')->assertJsonCount(1, 'data')->assertJsonPath('data.0.id', $nf->id);
    $this->getJson('/api/library?standard=K-ESS2')->assertJsonCount(1, 'data')->assertJsonPath('data.0.id', $ess->id);
    $this->getJson('/api/library?standard=%25')->assertStatus(422);
    $this->getJson('/api/library/materials?standard=3.NF')->assertOk()->assertJsonCount(1, 'data')->assertJsonPath('data.0.id', $mat->id);
});

test('a copy keeps its source test\'s standards', function () {
    $author = aTeacher();
    $source = aTestWithQuestions($author, 1, ['visibility' => 'public', 'published_at' => now(), 'standards' => ['5.NF.B.3']]);

    $copyId = $this->actingAs(aTeacher())->postJson("/api/tests/{$source->id}/copy")->assertCreated()->json('id');

    expect(Test::find($copyId)->standards)->toBe(['5.NF.B.3']);
});

test('a grade filter finds its band, and a band finds its grades', function () {
    $a = aTeacher();
    $pub = ['visibility' => 'public', 'published_at' => now()];
    $g3 = aTestWithQuestions($a, 1, $pub + ['grade_level' => 'grade-3']);
    $band = aTestWithQuestions($a, 1, $pub + ['grade_level' => '3-5']);
    aTestWithQuestions($a, 1, $pub + ['grade_level' => 'grade-4']);
    aTestWithQuestions($a, 1, $pub + ['grade_level' => '9-12']);

    $ids = fn (string $grade) => collect($this->getJson("/api/library?grade={$grade}")->assertOk()->json('data'))->pluck('id')->sort()->values()->all();

    expect($ids('grade-3'))->toBe(collect([$g3->id, $band->id])->sort()->values()->all());
    expect(count($ids('3-5')))->toBe(3);
});

test('every grade is either a band or sits in exactly one band', function () {
    foreach (GradeLevel::cases() as $level) {
        $band = $level->band();
        if ($band !== null) {
            expect($band->band())->toBeNull()
                ->and($level->matching())->toBe([$level->value, $band->value])
                ->and($band->matching())->toContain($level->value);
        } else {
            expect($level->matching()[0])->toBe($level->value);
        }
    }
});
