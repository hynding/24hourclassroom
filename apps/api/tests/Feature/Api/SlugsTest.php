<?php

use App\Enums\Role;
use App\Enums\SlugStatus;
use App\Models\UrlSlug;
use App\Models\User;

beforeEach(function () {
    config(['app.frontend_urls' => 'https://classroom.test']);
});

function anAdmin(): User
{
    return User::factory()->create(['role' => 'admin']);
}

function approveHandleFor(User $teacher, string $handle): UrlSlug
{
    test()->actingAs($teacher)->putJson('/api/profile/handle', ['handle' => $handle])->assertOk();
    $row = UrlSlug::where('slug', $handle)->firstOrFail();
    test()->actingAs(anAdmin())->post("/admin/slugs/{$row->id}/approve")->assertRedirect();
    app('auth')->forgetGuards();

    return $row->fresh();
}

function resolvePath($test, string $path)
{
    return $test->getJson('/api/resolve?path='.rawurlencode($path));
}

test('a handle waits for an admin, then names the teacher\'s page', function () {
    $teacher = aTeacher();

    $this->actingAs($teacher)->putJson('/api/profile/handle', ['handle' => 'Ms-Rivera '])
        ->assertOk()
        ->assertJsonPath('handle', null)
        ->assertJsonPath('request', ['slug' => 'ms-rivera', 'status' => 'pending'])
        ->assertJsonPath('path', "/teachers/{$teacher->id}");
    $this->app['auth']->forgetGuards();
    resolvePath($this, '/teachers/ms-rivera')->assertNotFound();

    approveHandleFor($teacher, 'ms-rivera');

    resolvePath($this, '/teachers/ms-rivera')->assertOk()->assertExactJson(['target' => "/teachers/{$teacher->id}", 'canonical' => '/teachers/ms-rivera']);
    $this->getJson("/api/users/{$teacher->id}")->assertJsonPath('path', '/teachers/ms-rivera');
});

test('only a Role::isPublic() role can ask for a handle', function () {
    foreach (Role::cases() as $role) {
        $user = User::factory()->create(['role' => $role]);
        $status = $this->actingAs($user)->putJson('/api/profile/handle', ['handle' => "h-{$role->value}"])->status();
        expect($status)->toBe($role->isPublic() ? 200 : 403, "role {$role->value}");
    }
});

test('slugs are validated: format, reserved words, digits only', function () {
    $teacher = aTeacher();
    foreach (['ab', 'Has Space', '-edge', 'double--hyphen', 'new', 'admin', '12345', str_repeat('a', 61)] as $bad) {
        $this->actingAs($teacher)->putJson('/api/profile/handle', ['handle' => $bad])->assertUnprocessable()->assertJsonValidationErrors('handle');
    }
});

test('a declined handle can be taken by nobody, and a taken one only by its owner', function () {
    [$a, $b] = [aTeacher(), aTeacher()];
    $this->actingAs($a)->putJson('/api/profile/handle', ['handle' => 'rude-name'])->assertOk();
    $row = UrlSlug::where('slug', 'rude-name')->first();
    $this->actingAs(anAdmin())->post("/admin/slugs/{$row->id}/reject")->assertRedirect();

    $this->actingAs($a)->putJson('/api/profile/handle', ['handle' => 'rude-name'])->assertUnprocessable();
    $this->actingAs($b)->putJson('/api/profile/handle', ['handle' => 'rude-name'])->assertUnprocessable();

    approveHandleFor($a, 'good-name');
    $this->actingAs($b)->putJson('/api/profile/handle', ['handle' => 'good-name'])->assertUnprocessable();
});

test('a course slug waits for the handle, then goes live with it (no review of its own)', function () {
    $teacher = aTeacher();
    $test = aTestWithQuestions($teacher, 1, ['visibility' => 'public', 'published_at' => now()]);
    $course = aCourse($teacher, [$test], ['visibility' => 'public', 'published_at' => now()]);

    $this->actingAs($teacher)->putJson("/api/courses/{$course->id}/slug", ['slug' => 'algebra-1'])
        ->assertOk()
        ->assertJsonPath('slug', ['slug' => 'algebra-1', 'status' => 'pending'])
        ->assertJsonPath('path', "/courses/{$course->id}");

    approveHandleFor($teacher, 'ms-rivera');

    $this->getJson("/api/courses/{$course->id}")->assertJsonPath('path', '/teachers/ms-rivera/algebra-1')->assertJsonMissingPath('slug');
    resolvePath($this, '/teachers/ms-rivera/algebra-1')->assertOk()->assertExactJson(['target' => "/courses/{$course->id}", 'canonical' => '/teachers/ms-rivera/algebra-1']);
    resolvePath($this, "/teachers/ms-rivera/algebra-1/tests/{$test->id}")->assertOk()
        ->assertJsonPath('target', "/courses/{$course->id}/tests/{$test->id}")
        ->assertJsonPath('canonical', "/teachers/ms-rivera/algebra-1/tests/{$test->id}");
    $this->getJson("/api/courses/{$course->id}/tests/{$test->id}")->assertJsonPath('course.path', '/teachers/ms-rivera/algebra-1');

    // With a handle, the next one is live at once.
    $this->actingAs($teacher)->putJson("/api/courses/{$course->id}/slug", ['slug' => 'algebra-one'])
        ->assertJsonPath('slug.status', 'approved')
        ->assertJsonPath('path', '/teachers/ms-rivera/algebra-one');
});

test('renamed handles and course slugs keep resolving, to the new address', function () {
    $teacher = aTeacher();
    $course = aCourse($teacher, [], ['visibility' => 'public', 'published_at' => now()]);
    approveHandleFor($teacher, 'old-handle');
    $this->actingAs($teacher)->putJson("/api/courses/{$course->id}/slug", ['slug' => 'old-course'])->assertOk();
    $this->actingAs($teacher)->putJson("/api/courses/{$course->id}/slug", ['slug' => 'new-course'])->assertOk();
    approveHandleFor($teacher, 'new-handle');

    expect(UrlSlug::where('slug', 'old-handle')->value('status'))->toBe(SlugStatus::Retired);
    resolvePath($this, '/teachers/old-handle')->assertJsonPath('canonical', '/teachers/new-handle');
    resolvePath($this, '/teachers/old-handle/old-course')->assertJsonPath('canonical', '/teachers/new-handle/new-course');

    // A cleared slug falls back to the id, and the old address still works.
    $this->actingAs($teacher)->putJson("/api/courses/{$course->id}/slug", ['slug' => null])->assertJsonPath('path', "/courses/{$course->id}")->assertJsonPath('slug', null);
    $this->app['auth']->forgetGuards();
    resolvePath($this, '/teachers/new-handle/new-course')->assertJsonPath('canonical', "/courses/{$course->id}");
});

test('a slug never widens access: a private course resolves for its author only', function () {
    $teacher = aTeacher();
    $course = aCourse($teacher);
    approveHandleFor($teacher, 'ms-rivera');
    $this->actingAs($teacher)->putJson("/api/courses/{$course->id}/slug", ['slug' => 'drafts'])->assertOk();
    resolvePath($this, '/teachers/ms-rivera/drafts')->assertOk();

    $this->actingAs(aTeacher());
    resolvePath($this, '/teachers/ms-rivera/drafts')->assertNotFound();
    $this->app['auth']->forgetGuards();
    resolvePath($this, '/teachers/ms-rivera/drafts')->assertNotFound();

    $teacher->forceFill(['deactivated_at' => now()])->save();
    resolvePath($this, '/teachers/ms-rivera')->assertNotFound();
});

test('only the author names a course', function () {
    $course = aCourse(aTeacher(), [], ['visibility' => 'public', 'published_at' => now()]);
    $this->actingAs(aTeacher())->putJson("/api/courses/{$course->id}/slug", ['slug' => 'mine-now'])->assertForbidden();
    $this->actingAs(aTeacher())->putJson('/api/courses/'.aCourse(aTeacher())->id.'/slug', ['slug' => 'mine-now'])->assertNotFound();
    expect(UrlSlug::count())->toBe(0);
});

test('a site address beats the teacher\'s, and a retired one is never reissued', function () {
    $teacher = aTeacher();
    $course = aCourse($teacher, [], ['visibility' => 'public', 'published_at' => now()]);
    $other = aCourse($teacher, [], ['visibility' => 'public', 'published_at' => now()]);
    approveHandleFor($teacher, 'ms-rivera');
    $this->actingAs($teacher)->putJson("/api/courses/{$course->id}/slug", ['slug' => 'precalc'])->assertOk();

    $this->actingAs(anAdmin());
    $this->put('/admin/slugs/site-course', ['course_id' => $course->id, 'slug' => 'precalculus'])->assertRedirect()->assertSessionHasNoErrors();
    $this->app['auth']->forgetGuards();

    $this->getJson("/api/courses/{$course->id}")->assertJsonPath('path', '/courses/precalculus');
    resolvePath($this, '/courses/precalculus')->assertExactJson(['target' => "/courses/{$course->id}", 'canonical' => '/courses/precalculus']);
    resolvePath($this, '/teachers/ms-rivera/precalc')->assertJsonPath('canonical', '/courses/precalculus');

    $this->actingAs(anAdmin());
    $this->put('/admin/slugs/site-course', ['course_id' => $course->id, 'slug' => null])->assertRedirect();
    $this->put('/admin/slugs/site-course', ['course_id' => $other->id, 'slug' => 'precalculus'])->assertSessionHasErrors('slug');
    $this->app['auth']->forgetGuards();
    resolvePath($this, '/courses/precalculus')->assertJsonPath('canonical', '/teachers/ms-rivera/precalc');
});

test('non-admins cannot reach the address admin', function () {
    $this->actingAs(aTeacher())->putJson('/api/profile/handle', ['handle' => 'ms-rivera']);
    $row = UrlSlug::first();
    $course = aCourse(aTeacher());
    foreach (Role::cases() as $role) {
        if ($role === Role::Admin) {
            continue;
        }
        $this->actingAs(User::factory()->create(['role' => $role]));
        $this->get('/admin/slugs')->assertForbidden();
        $this->post("/admin/slugs/{$row->id}/approve")->assertForbidden();
        $this->put('/admin/slugs/site-course', ['course_id' => $course->id, 'slug' => 'x-y-z'])->assertForbidden();
    }
    expect($row->fresh()->status)->toBe(SlugStatus::Pending);

    $this->actingAs(anAdmin());
    $props = $this->get('/admin/slugs')->assertOk()->viewData('page')['props'];
    expect(collect($props['pending'])->pluck('slug')->all())->toBe(['ms-rivera']);
});

test('the sitemap and the server-rendered head use the canonical address', function () {
    $teacher = aTeacher();
    $course = aCourse($teacher, [], ['visibility' => 'public', 'published_at' => now(), 'title' => 'Precalculus']);
    approveHandleFor($teacher, 'ms-rivera');
    $this->actingAs(anAdmin())->put('/admin/slugs/site-course', ['course_id' => $course->id, 'slug' => 'precalculus']);
    $this->app['auth']->forgetGuards();

    $sitemap = $this->get('/api/sitemap.xml')->getContent();
    expect($sitemap)->toContain('<loc>https://classroom.test/courses/precalculus</loc>')
        ->toContain('<loc>https://classroom.test/teachers/ms-rivera</loc>')
        ->not->toContain("/courses/{$course->id}<");

    foreach (['/courses/precalculus', "/courses/{$course->id}"] as $path) {
        $head = $this->getJson('/api/page-head?path='.rawurlencode($path))->assertOk()->json('head');
        expect($head)->toContain('<link rel="canonical" href="https://classroom.test/courses/precalculus" data-page-meta>')
            ->toContain('<title>Precalculus · ');
    }
});
