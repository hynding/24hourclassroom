<?php

use App\Enums\Role;
use App\Models\Test;
use App\Models\User;
use App\Notifications\TestModerated;

function testsAdmin(): User
{
    return User::factory()->create(['role' => 'admin']);
}

test('non-admin roles cannot reach the tests moderation page', function () {
    foreach (Role::cases() as $role) {
        if ($role === Role::Admin) {
            continue;
        }
        $this->actingAs(User::factory()->create(['role' => $role->value]));
        $this->get('/admin/tests')->assertStatus(403);
    }
    $this->app['auth']->forgetGuards();
    $this->get('/admin/tests')->assertRedirect('/login');
});

test('the admin lists public tests, searches, unpublishes with a notification, and deletes', function () {
    $author = aTeacher();
    $public = aTestWithQuestions($author, 1, ['visibility' => 'public', 'published_at' => now(), 'title' => 'Volcanoes']);
    aTestWithQuestions($author, 1, ['title' => 'Private draft']);
    $this->actingAs(testsAdmin());

    $ids = collect($this->get('/admin/tests')->assertOk()->viewData('page')['props']['tests']['data'])->pluck('id');
    expect($ids->all())->toBe([$public->id]);
    expect(collect($this->get('/admin/tests?q=volc')->viewData('page')['props']['tests']['data'])->pluck('id')->all())->toBe([$public->id]);
    expect($this->get('/admin/tests?q=zzz')->viewData('page')['props']['tests']['data'])->toBe([]);

    $this->post("/admin/tests/{$public->id}/unpublish")->assertRedirect();
    expect($public->fresh()->visibility->value)->toBe('private')
        ->and($author->notifications()->first()->type)->toBe(TestModerated::class)
        ->and($author->notifications()->first()->data['test_title'])->toBe('Volcanoes');

    $this->delete("/admin/tests/{$public->id}")->assertRedirect();
    expect(Test::find($public->id))->toBeNull();
});
