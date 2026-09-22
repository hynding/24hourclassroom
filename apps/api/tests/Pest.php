<?php

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
|
| The closure you provide to your test functions is always bound to a specific PHPUnit test
| case class. By default, that class is "PHPUnit\Framework\TestCase". Of course, you may
| need to change it using the "pest()" function to bind a different classes or traits.
|
*/

pest()->extend(Tests\TestCase::class)
    ->use(Illuminate\Foundation\Testing\RefreshDatabase::class)
    ->in('Feature', 'Unit');

/*
|--------------------------------------------------------------------------
| Expectations
|--------------------------------------------------------------------------
|
| When you're writing tests, you often need to check that values meet certain conditions. The
| "expect()" function gives you access to a set of "expectations" methods that you can use
| to assert different things. Of course, you may extend the Expectation API at any time.
|
*/

expect()->extend('toBeOne', function () {
    return $this->toBe(1);
});

/*
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
|
| While Pest is very powerful out-of-the-box, you may have some testing code specific to your
| project that you don't want to repeat in every file. Here you can also expose helpers as
| global functions to help you to reduce the number of lines of code in your test files.
|
*/

use App\Models\Connection;
use App\Models\Material;
use App\Models\MaterialShare;
use App\Models\Question;
use App\Models\Test;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

function aTeacher(array $attrs = []): User
{
    return User::factory()->create(['role' => 'teacher', ...$attrs]);
}

function aStudent(array $attrs = []): User
{
    return User::factory()->create(['role' => 'student', ...$attrs]);
}

function connectAccepted(User $a, User $b): Connection
{
    return Connection::create([
        'requester_id' => $a->id,
        'addressee_id' => $b->id,
        'status' => 'accepted',
        'pair_key' => Connection::pairKey($a->id, $b->id),
    ]);
}

function aTestWithQuestions(User $author, int $count = 2, array $attrs = []): Test
{
    $test = Test::factory()->for($author, 'author')->create($attrs);
    for ($i = 0; $i < $count; $i++) {
        Question::factory()->for($test)->create(['position' => $i]);
    }

    return $test;
}

/**
 * A material row PLUS its bytes: every download and delete test needs a real
 * file at the row's `path`, and Storage::fake() starts empty. The caller is
 * responsible for Storage::fake(config('materials.disk')) in beforeEach.
 */
function aMaterial(User $author, array $attrs = []): Material
{
    $material = Material::factory()->for($author, 'author')->create($attrs);

    Storage::disk(config('materials.disk'))->put(
        $material->path,
        file_get_contents(base_path('tests/Fixtures/materials/sample.pdf')),
    );

    return $material;
}

function shareWith(Material $material, User $recipient): MaterialShare
{
    return MaterialShare::create(['material_id' => $material->id, 'user_id' => $recipient->id]);
}

/**
 * A real file from tests/Fixtures/materials, optionally under a different
 * client name. `test: true` is mandatory -- UploadedFile rejects a path that
 * did not arrive through PHP's upload machinery otherwise. Never
 * UploadedFile::fake(): that derives getMimeType() from the FILENAME, so the
 * `mimetypes:` rule would be untested.
 */
function materialFixture(string $name, ?string $clientName = null): UploadedFile
{
    return new UploadedFile(
        base_path("tests/Fixtures/materials/{$name}"),
        $clientName ?? $name,
        null,
        null,
        true,
    );
}

/**
 * A complete, valid POST /tests body with one question of every type -- the
 * non-HTTP twin of TestAuthoringTest's file-local validTestBody(), which
 * must NOT be redefined here (a second global declaration is a fatal).
 * Used by QuestionShapesTest and the MCP tool tests.
 */
function validDraftBody(array $overrides = []): array
{
    return array_merge([
        'title' => 'Fractions warm-up',
        'description' => 'Ten minutes.',
        'subject' => 'math',
        'grade_level' => '3-5',
        'questions' => [
            ['type' => 'multiple_choice', 'prompt' => '1/2 + 1/4?', 'options' => ['1/4', '3/4', '1'], 'answer' => 1, 'points' => 2, 'explanation' => 'Common denominator.'],
            ['type' => 'multi_select', 'prompt' => 'Which are > 1/2?', 'options' => ['1/3', '2/3', '3/4'], 'answer' => [1, 2], 'partial_credit' => true],
            ['type' => 'true_false', 'prompt' => '1/2 > 1/3', 'answer' => true],
            ['type' => 'short_answer', 'prompt' => 'Name a unit fraction.', 'answer' => '1/2'],
            ['type' => 'numeric', 'prompt' => '0.5 as a fraction of 4?', 'answer' => ['value' => 2, 'tolerance' => 0]],
        ],
    ], $overrides);
}

/**
 * The only token this app mints: one ability, no expiry. Returns the
 * plaintext, which is the last time it exists.
 */
function mcpToken(User $user, string $name = 'Claude Code'): string
{
    return $user->createToken($name, ['mcp'])->plainTextToken;
}

/**
 * A JSON-RPC body with no `params._meta`, which ValidateMcpHeaders treats
 * as "legacy" and passes through without protocol-meta validation -- so a
 * feature test can assert auth statuses without a full MCP handshake.
 *
 * @return array<string, mixed>
 */
function mcpPing(): array
{
    return ['jsonrpc' => '2.0', 'id' => 1, 'method' => 'ping'];
}
