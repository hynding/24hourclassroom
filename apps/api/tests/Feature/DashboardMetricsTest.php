<?php

use App\Enums\GenerationStatus;
use App\Models\Follow;
use App\Models\Generation;
use App\Models\SiteSetting;
use App\Models\User;
use App\Support\AdminMetrics;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

beforeEach(function () {
    Storage::fake(config('materials.disk'));
});

test('people: counts by role, verified share, the two sign-up windows, stale unverified, follows and connections', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $staleUnverified = User::factory()->unverified()->create(['role' => 'teacher', 'created_at' => now()->subDays(8)]);
    $recentStudent = User::factory()->create(['role' => 'student', 'created_at' => now()->subDays(6)]);
    $oldTeacher = User::factory()->create(['role' => 'teacher', 'created_at' => now()->subDays(40)]);
    Follow::create(['follower_id' => $recentStudent->id, 'followed_id' => $oldTeacher->id]);
    connectAccepted($oldTeacher, $recentStudent);

    $this->actingAs($admin);
    $people = $this->get('/dashboard')->viewData('page')['props']['metrics']['people'];

    expect($people['by_role'])->toBe(['teacher' => 2, 'student' => 1, 'admin' => 1])
        ->and($people['verified_percentage'])->toBe(75)
        ->and($people['new_7d'])->toBe(2)
        ->and($people['new_30d'])->toBe(3)
        ->and($people['unverified_7d_plus'])->toBe(1)
        ->and($people['follows'])->toBe(1)
        ->and($people['connections'])->toBe(1);
});

test('content: public and private counts and the 30-day publish window, for tests and materials', function () {
    $author = aTeacher();
    aTestWithQuestions($author, 1, ['visibility' => 'public', 'published_at' => now()]);
    aTestWithQuestions($author, 1, ['visibility' => 'public', 'published_at' => now()->subDays(40)]);
    aTestWithQuestions($author, 1);
    aMaterial($author, ['visibility' => 'public', 'published_at' => now()->subDays(2)]);
    aMaterial($author);
    aMaterial($author);

    $this->actingAs(User::factory()->create(['role' => 'admin']));
    $content = $this->get('/dashboard')->viewData('page')['props']['metrics']['content'];

    expect($content['tests'])->toBe(['private' => 1, 'public' => 2, 'published_30d' => 1])
        ->and($content['materials'])->toBe(['private' => 2, 'public' => 1, 'published_30d' => 1]);
});

test('generations: every status present, live total, cost per window with its own unpriced count, and terminal-only leftovers', function () {
    $owner = aTeacher();
    // One row per status, unpriced, with a session and no archived_at: the
    // terminal ones are leftovers, the live ones are runs in progress.
    foreach (GenerationStatus::cases() as $status) {
        Generation::factory()->for($owner)->create(['status' => $status->value, 'session_id' => 'sesn_'.$status->value, 'archived_at' => null, 'list_cost_cents' => null]);
    }
    Generation::factory()->for($owner)->done()->create(['list_cost_cents' => 100]);
    Generation::factory()->for($owner)->done()->create(['list_cost_cents' => 100]);
    Generation::factory()->for($owner)->done()->create(['list_cost_cents' => 50, 'created_at' => now()->subDays(40)]);

    $this->actingAs(User::factory()->create(['role' => 'admin']));
    $generations = $this->get('/dashboard')->viewData('page')['props']['metrics']['generations'];

    $terminal = count(GenerationStatus::terminal());
    $live = count(GenerationStatus::cases()) - $terminal;

    expect(array_keys($generations['by_status']))->toBe(array_column(GenerationStatus::cases(), 'value'))
        ->and($generations['by_status'][GenerationStatus::Done->value])->toBe(4)
        ->and($generations['by_status'][GenerationStatus::Running->value])->toBe(1)
        ->and($generations['live'])->toBe($live)
        ->and($generations['cost_30d'])->toBe(['cents' => 200, 'unpriced' => count(GenerationStatus::cases())])
        ->and($generations['cost_all'])->toBe(['cents' => 250, 'unpriced' => count(GenerationStatus::cases())])
        ->and($generations['leftovers'])->toBe($terminal);
});

test('recent sign-ups are the newest ten with email, role and verified', function () {
    $admin = User::factory()->create(['role' => 'admin', 'created_at' => now()->subDays(30)]);
    $users = collect(range(1, 11))->map(fn (int $i) => User::factory()->create([
        'role' => 'teacher', 'created_at' => now()->subMinutes(60 - $i),
    ]));
    $newest = $users->last();

    $this->actingAs($admin);
    $recent = $this->get('/dashboard')->viewData('page')['props']['metrics']['recent_users'];

    expect($recent)->toHaveCount(10)
        ->and($recent[0]['id'])->toBe($newest->id)
        ->and(array_keys($recent[0]))->toBe(['id', 'name', 'email', 'role', 'verified', 'created_at'])
        ->and($recent[0]['email'])->toBe($newest->email)
        ->and($recent[0]['role'])->toBe('teacher')
        ->and($recent[0]['verified'])->toBeTrue()
        ->and(collect($recent)->pluck('id'))->not->toContain($admin->id);
});

test('an empty site is all zeroes with every status key present and no division by zero', function () {
    $this->actingAs(User::factory()->create(['role' => 'admin']));
    $metrics = $this->get('/dashboard')->viewData('page')['props']['metrics'];

    expect($metrics['people']['by_role'])->toBe(['teacher' => 0, 'student' => 0, 'admin' => 1])
        ->and($metrics['people']['verified_percentage'])->toBe(100)
        ->and($metrics['content']['tests'])->toBe(['private' => 0, 'public' => 0, 'published_30d' => 0])
        ->and($metrics['generations']['by_status'])->toBe(array_fill_keys(array_column(GenerationStatus::cases(), 'value'), 0))
        ->and($metrics['generations']['live'])->toBe(0)
        ->and($metrics['generations']['cost_all'])->toBe(['cents' => 0, 'unpriced' => 0])
        ->and($metrics['generations']['leftovers'])->toBe(0)
        ->and($metrics['recent_users'])->toHaveCount(1);
});

test('the metrics are cached for a minute', function () {
    // No Cache::flush() between tests is needed: phpunit.xml sets the array
    // store and every test boots a fresh container.
    $this->actingAs(User::factory()->create(['role' => 'admin']));

    $first = $this->get('/dashboard')->viewData('page')['props']['metrics']['people']['by_role']['teacher'];
    aTeacher();
    $second = $this->get('/dashboard')->viewData('page')['props']['metrics']['people']['by_role']['teacher'];
    Cache::forget(AdminMetrics::CACHE_KEY);
    $third = $this->get('/dashboard')->viewData('page')['props']['metrics']['people']['by_role']['teacher'];

    expect($first)->toBe(0)
        ->and($second)->toBe(0)
        ->and($third)->toBe(1);
});

test('a non-admin gets no metrics at all', function () {
    // Null rather than zeroes: a teacher must not learn the platform's user
    // counts from a prop the page simply chose not to render.
    $this->actingAs(User::factory()->create(['role' => 'teacher']));

    expect($this->get('/dashboard')->viewData('page')['props']['metrics'])->toBeNull();
});

test('an admin sees the sign-up switch; everyone else gets null', function () {
    SiteSetting::current()->update(['registration_open' => false]);

    $this->actingAs(User::factory()->create(['role' => 'admin']));
    expect($this->get('/dashboard')->viewData('page')['props']['registration'])->toBe(['open' => false]);

    $this->actingAs(User::factory()->create(['role' => 'teacher']));
    expect($this->get('/dashboard')->viewData('page')['props']['registration'])->toBeNull();
});
