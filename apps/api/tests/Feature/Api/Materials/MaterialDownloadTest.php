<?php

use App\Enums\Role;
use App\Models\Material;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

beforeEach(function () {
    $this->withHeader('Referer', 'http://localhost:3333');
    Storage::fake(config('materials.disk'));
});

function downloadUrlFor(Material $material, ?User $viewer = null, int $minutes = 15): string
{
    return URL::temporarySignedRoute('materials.file', now()->addMinutes($minutes), [
        'material' => $material->id,
        'viewer' => $viewer?->id ?? 0,
    ], absolute: false);
}

test('the author, a live recipient, a public viewer and a guest can all fetch', function () {
    $author = aTeacher();
    $private = aMaterial($author);
    $recipient = aStudent();
    shareWith($private, $recipient);
    connectAccepted($author, $recipient);
    $public = aMaterial($author, ['visibility' => 'public', 'published_at' => now()]);

    $bytes = file_get_contents(base_path('tests/Fixtures/materials/sample.pdf'));

    $this->get(downloadUrlFor($private, $author))->assertOk()->assertStreamedContent($bytes);
    $this->get(downloadUrlFor($private, $recipient))->assertOk()->assertStreamedContent($bytes);
    $this->get(downloadUrlFor($public, aStudent()))->assertOk()->assertStreamedContent($bytes);
    $this->get(downloadUrlFor($public))->assertOk()->assertStreamedContent($bytes);

    // A private material is 404 for a signed URL naming an uninvolved viewer:
    // the signature proves the link, `canView` decides the answer.
    $this->get(downloadUrlFor($private, aTeacher()))->assertStatus(404);
    $this->get(downloadUrlFor($private))->assertStatus(404);
});

test('the response is an attachment with the stored mime type, nosniff, and a safe ASCII fallback name', function () {
    $author = aTeacher();
    // A name with a percent AND non-ASCII characters: Symfony refuses to build
    // a Content-Disposition fallback containing '%', and Laravel strips it
    // (Str::ascii minus %). Without that, download() throws a 500.
    // Double quotes: \u{00E9} is only an escape there. The stored name is
    // `report%20 été.pdf`.
    $material = aMaterial($author, ['original_name' => "report%20 \u{00E9}t\u{00E9}.pdf", 'mime_type' => 'application/pdf']);

    $response = $this->get(downloadUrlFor($material, $author))->assertOk();

    expect($response->headers->get('Content-Type'))->toBe('application/pdf')
        ->and($response->headers->get('X-Content-Type-Options'))->toBe('nosniff')
        ->and($response->headers->get('Content-Disposition'))->toStartWith('attachment;')
        ->and($response->headers->get('Content-Disposition'))->toContain("filename*=utf-8''");
});

test('a tampered signature is 403 for an existing and a nonexistent id alike', function () {
    // Debug bodies embed the calling line; the oracle check needs the production shape.
    config(['app.debug' => false]);
    $author = aTeacher();
    $material = aMaterial($author, ['visibility' => 'public', 'published_at' => now()]);

    $tampered = downloadUrlFor($material).'&x=1';
    $existing = $this->getJson($tampered)->assertStatus(403);
    $missing = $this->getJson('/api/materials/999999/file?viewer=0&expires=9999999999&signature=deadbeef')->assertStatus(403);

    // Byte-identical: an invalid signature must not be an existence oracle.
    expect($existing->getContent())->toBe($missing->getContent());

    // The real client is a browser navigation, which asks for HTML and gets
    // Laravel's generic error page -- constant, so still no oracle.
    $html = $this->get($tampered, ['Accept' => 'text/html'])->assertStatus(403);
    expect($html->headers->get('Content-Type'))->toContain('text/html');
});

test('an expired signature is 403', function () {
    $author = aTeacher();
    $material = aMaterial($author, ['visibility' => 'public', 'published_at' => now()]);
    $url = downloadUrlFor($material);

    $this->get($url)->assertOk();
    $this->travel(16)->minutes();
    $this->getJson($url)->assertStatus(403);
});

test('a deactivated viewer is treated as a guest: public still works, a share does not', function () {
    $author = aTeacher();
    $public = aMaterial($author, ['visibility' => 'public', 'published_at' => now()]);
    $private = aMaterial($author);
    $recipient = aStudent();
    shareWith($private, $recipient);
    connectAccepted($author, $recipient);

    $publicUrl = downloadUrlFor($public, $recipient);
    $privateUrl = downloadUrlFor($private, $recipient);
    $this->get($privateUrl)->assertOk();

    $recipient->forceFill(['deactivated_at' => now()])->save();

    $this->get($publicUrl)->assertOk();
    $this->getJson($privateUrl)->assertStatus(404);
});

test('a live URL is revoked by unpublishing, unsharing, disconnecting, deleting, or losing the file', function () {
    $author = aTeacher();

    $published = aMaterial($author, ['visibility' => 'public', 'published_at' => now()]);
    $publishedUrl = downloadUrlFor($published);
    $this->get($publishedUrl)->assertOk();
    $published->update(['visibility' => 'private']);
    $this->getJson($publishedUrl)->assertStatus(404);

    $shared = aMaterial($author);
    $recipient = aStudent();
    $share = shareWith($shared, $recipient);
    $connection = connectAccepted($author, $recipient);
    $sharedUrl = downloadUrlFor($shared, $recipient);
    $this->get($sharedUrl)->assertOk();
    $share->delete();
    $this->getJson($sharedUrl)->assertStatus(404);

    $stillShared = aMaterial($author);
    shareWith($stillShared, $recipient);
    $connectedUrl = downloadUrlFor($stillShared, $recipient);
    $this->get($connectedUrl)->assertOk();
    $connection->delete();
    $this->getJson($connectedUrl)->assertStatus(404);

    $doomed = aMaterial($author);
    $doomedUrl = downloadUrlFor($doomed, $author);
    $this->get($doomedUrl)->assertOk();
    $doomed->delete();
    $this->getJson($doomedUrl)->assertStatus(404);

    // A file removed out of band must be a 404, not the 500 that download()'s
    // unguarded size() call for Content-Length would otherwise produce -- with
    // the storage path in the message under APP_DEBUG.
    $orphan = aMaterial($author);
    $orphanUrl = downloadUrlFor($orphan, $author);
    Storage::disk(config('materials.disk'))->delete($orphan->path);
    $this->getJson($orphanUrl)->assertStatus(404);
});

test('every role can be the signed viewer without the route ever consulting a session', function () {
    $author = aTeacher();
    $material = aMaterial($author, ['visibility' => 'public', 'published_at' => now()]);

    foreach (Role::cases() as $role) {
        $viewer = User::factory()->create(['role' => $role->value]);
        $this->get(downloadUrlFor($material, $viewer))->assertOk();
    }
});

test('downloads have their own limiter, separate from the caller 60/min bucket', function () {
    $author = aTeacher();
    $material = aMaterial($author, ['visibility' => 'public', 'published_at' => now()]);
    $this->actingAs($author);

    // Exhaust the shared authenticated bucket (CLAUDE.md: one 60/min budget
    // spans the whole group, keyed on sha1(user id)).
    for ($i = 0; $i < 60; $i++) {
        $this->getJson('/api/connections')->assertOk();
    }
    $this->getJson('/api/connections')->assertStatus(429);

    // The signed download is unaffected.
    $this->get(downloadUrlFor($material, $author))->assertOk();
});

test('the 31st download in a minute is 429 while JSON requests still pass', function () {
    $author = aTeacher();
    $material = aMaterial($author, ['visibility' => 'public', 'published_at' => now()]);
    $this->actingAs($author);

    for ($i = 0; $i < 30; $i++) {
        $this->get(downloadUrlFor($material, $author))->assertOk();
    }
    $this->get(downloadUrlFor($material, $author))->assertStatus(429);

    $this->getJson('/api/connections')->assertOk();
});

test('the framework serve route for the private disk is not registered', function () {
    // config('filesystems.disks.local.serve') is false: MaterialFileController must be the only route to material bytes.
    expect(\Illuminate\Support\Facades\Route::has('storage.local'))->toBeFalse();
});
