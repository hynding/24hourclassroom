<?php

use App\Enums\Role;
use App\Models\Course;
use App\Models\Test;
use App\Models\User;
use App\Notifications\CourseModerated;

test('non-admin roles cannot reach the courses moderation page', function () {
    $course = aCourse(aTeacher(), [], ['visibility' => 'public', 'published_at' => now()]);
    foreach (Role::cases() as $role) {
        if ($role === Role::Admin) {
            continue;
        }
        $this->actingAs(User::factory()->create(['role' => $role->value]));
        $this->get('/admin/courses')->assertStatus(403);
        $this->post("/admin/courses/{$course->id}/unpublish")->assertStatus(403);
        $this->delete("/admin/courses/{$course->id}")->assertStatus(403);
    }
    $this->app['auth']->forgetGuards();
    $this->get('/admin/courses')->assertRedirect('/login');
    expect($course->fresh()->visibility->value)->toBe('public');
});

test('the admin lists public courses, searches, unpublishes with a notification, and deletes the course alone', function () {
    $author = aTeacher();
    $quiz = aTestWithQuestions($author, 1, ['visibility' => 'public', 'published_at' => now()]);
    $public = aCourse($author, [$quiz], ['visibility' => 'public', 'published_at' => now(), 'title' => 'Volcanology']);
    aCourse($author, [], ['title' => 'Private draft']);
    $this->actingAs(User::factory()->create(['role' => 'admin']));

    $rows = $this->get('/admin/courses')->assertOk()->viewData('page')['props']['courses']['data'];
    expect(collect($rows)->pluck('id')->all())->toBe([$public->id])
        ->and($rows[0]['item_count'])->toBe(1);
    expect(collect($this->get('/admin/courses?q=volc')->viewData('page')['props']['courses']['data'])->pluck('id')->all())->toBe([$public->id]);
    expect($this->get('/admin/courses?q=zzz')->viewData('page')['props']['courses']['data'])->toBe([]);

    $this->post("/admin/courses/{$public->id}/unpublish")->assertRedirect();
    expect($public->fresh()->visibility->value)->toBe('private')
        ->and($author->notifications()->first()->type)->toBe(CourseModerated::class)
        ->and($author->notifications()->first()->data['course_title'])->toBe('Volcanology')
        // The test is moderated on its own page; the course's unpublish leaves it be.
        ->and($quiz->fresh()->visibility->value)->toBe('public');

    $this->delete("/admin/courses/{$public->id}")->assertRedirect();
    expect(Course::find($public->id))->toBeNull()
        ->and(Test::find($quiz->id))->not->toBeNull();
});
