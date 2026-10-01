<?php

namespace App\Support;

use App\Enums\Role;
use App\Enums\Visibility;
use App\Models\Assignment;
use App\Models\Attempt;
use App\Models\Connection;
use App\Models\Follow;
use App\Models\Generation;
use App\Models\Integration;
use App\Models\Material;
use App\Models\MaterialShare;
use App\Models\Test;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Notifications\DatabaseNotification;

/**
 * The admin detail page's view of one account. Built field by field, never
 * ->toArray(): google_id, deactivated_at and avatar_path are $hidden. Every
 * enum is emitted as ->value and every date as ISO 8601, like
 * AdminGenerationPayload. The API key never appears: has_key is a
 * whereNotNull on the ciphertext column, never apiKey(), which clears the
 * row on an APP_KEY rotation.
 */
final class AdminUserPayload
{
    private const RELATED_LIMIT = 50;

    private const CONTENT_LIMIT = 10;

    /**
     * Booleans rather than two Users so the argument order cannot be
     * silently swapped with AdminTarget::isActionable(actor, target).
     *
     * @return array<string, mixed>
     */
    public static function detail(User $target, bool $actionable, bool $isSelf): array
    {
        return [
            'user' => self::user($target, $actionable, $isSelf),
            'profile' => self::profile($target),
            'integration' => self::integration($target),
            'counts' => self::counts($target),
            'following' => self::follows($target, 'follower_id', 'followed'),
            'followers' => self::follows($target, 'followed_id', 'follower'),
            'connections' => self::connections($target),
            'tests' => self::tests($target),
            'materials' => self::materials($target),
            'generations' => $target->generations()
                ->with('user:id,name') // AdminGenerationPayload::row dereferences it
                ->orderByDesc('created_at')->orderByDesc('id')
                ->limit(self::CONTENT_LIMIT)
                ->get()
                ->map(fn (Generation $g) => AdminGenerationPayload::row($g))
                ->all(),
            'notifications' => self::notifications($target),
        ];
    }

    /** The ciphertext column is non-null exactly when a key exists; the same predicate D1's GenerationAdminController uses. */
    public static function hasKey(User $target): bool
    {
        return Integration::query()->where('user_id', $target->id)->whereNotNull('anthropic_api_key')->exists();
    }

    /** @return array<string, mixed> */
    private static function user(User $target, bool $actionable, bool $isSelf): array
    {
        return [
            'id' => $target->id,
            'name' => $target->name,
            'email' => $target->email,
            'role' => $target->role->value,
            'email_verified_at' => $target->email_verified_at?->toIso8601String(),
            'created_at' => $target->created_at->toIso8601String(),
            'deactivated_at' => $target->deactivated_at?->toIso8601String(),
            'google_linked' => $target->google_id !== null,
            'is_self' => $isSelf,
            'actionable' => $actionable,
            // Allowlist from the enum: the page maps these to buttons and
            // never compares role to a literal.
            'role_options' => $actionable
                ? array_values(array_diff([Role::Teacher->value, Role::Student->value], [$target->role->value]))
                : [],
        ];
    }

    /** @return array<string, mixed>|null */
    private static function profile(User $target): ?array
    {
        $profile = $target->profile;

        if ($profile === null) {
            return null;
        }

        return [
            'bio' => $profile->bio,
            'school' => $profile->school,
            'specialties' => $profile->specialties,
            'subjects' => $profile->subjects ?? [],
            'grade_levels' => $profile->grade_levels ?? [],
            'avatar_url' => $profile->avatar_url,
        ];
    }

    /** @return array<string, mixed>|null */
    private static function integration(User $target): ?array
    {
        // The HasOne, never Integration::forUser(): that is createOrFirst
        // and would turn a GET into a write.
        $integration = $target->integration;

        if ($integration === null) {
            return null;
        }

        return [
            'has_key' => self::hasKey($target),
            'key_hint' => $integration->anthropic_key_hint,
            'key_verified_at' => $integration->anthropic_key_verified_at?->toIso8601String(),
            'provisioned' => $integration->anthropic_environment_id !== null && $integration->anthropic_agent_id !== null,
        ];
    }

    /** @return array<string, mixed> */
    private static function counts(User $target): array
    {
        $testIds = Test::where('user_id', $target->id)->select('id');
        $materialIds = Material::where('user_id', $target->id)->select('id');

        return [
            'tests' => self::byVisibility(Test::where('user_id', $target->id)),
            'materials' => self::byVisibility(Material::where('user_id', $target->id)),
            'generations_live' => $target->generations()->live()->count(),
            'generations_total' => $target->generations()->count(),
            'attempts_taken' => Attempt::where('student_id', $target->id)->count(),
            // By OTHER users: the number the Delete block quotes as other students' work.
            'attempts_received' => Attempt::whereIn('test_id', $testIds)->where('student_id', '!=', $target->id)->count(),
            // Either side, so the number survives a role change (a demoted
            // teacher keeps their teacher_id rows; a promoted student their student_id rows).
            'assignments' => Assignment::where('student_id', $target->id)->orWhere('teacher_id', $target->id)->count(),
            'shares_out' => MaterialShare::whereIn('material_id', $materialIds)->count(),
            'tokens' => $target->tokens()->count(),
        ];
    }

    /**
     * Zero-filled over Visibility::cases(), plucked on the builder so the key
     * is the raw value (AdminMetrics::countBy's rule).
     *
     * @return array<string, int>
     */
    private static function byVisibility(Builder $query): array
    {
        $counts = $query->selectRaw('visibility, count(*) as c')->groupBy('visibility')->pluck('c', 'visibility');

        $out = [];
        foreach (Visibility::cases() as $case) {
            $out[$case->value] = (int) ($counts[$case->value] ?? 0);
        }

        return $out;
    }

    /**
     * Built directly, not via UserSummary::for (which nulls a non-teacher's
     * avatar) or ConnectionController::outgoingSummary (which redacts a
     * pending student): the admin view bypasses both public redactions.
     *
     * @return array{id: int, name: string, role: string}
     */
    private static function related(User $user): array
    {
        return ['id' => $user->id, 'name' => $user->name, 'role' => $user->role->value];
    }

    /** @return list<array<string, mixed>> */
    private static function follows(User $target, string $column, string $relation): array
    {
        return Follow::where($column, $target->id)
            ->with("{$relation}:id,name,role")
            ->orderByDesc('created_at')->orderByDesc('id')
            ->limit(self::RELATED_LIMIT)
            ->get()
            ->map(fn (Follow $follow) => ['follow_id' => $follow->id, 'user' => self::related($follow->{$relation})])
            ->all();
    }

    /** @return list<array<string, mixed>> */
    private static function connections(User $target): array
    {
        return Connection::where(fn ($q) => $q->where('requester_id', $target->id)->orWhere('addressee_id', $target->id))
            ->with('requester:id,name,role', 'addressee:id,name,role')
            ->orderByDesc('created_at')->orderByDesc('id')
            ->limit(self::RELATED_LIMIT)
            ->get()
            ->map(fn (Connection $c) => [
                'id' => $c->id,
                'counterpart' => self::related($c->counterpart($target)),
                'status' => $c->status->value,
                'created_at' => $c->created_at->toIso8601String(),
            ])
            ->all();
    }

    /** @return list<array<string, mixed>> */
    private static function tests(User $target): array
    {
        return Test::where('user_id', $target->id)
            ->withCount('questions') // live questions: Question soft-deletes
            ->orderByDesc('created_at')->orderByDesc('id')
            ->limit(self::CONTENT_LIMIT)
            ->get()
            ->map(fn (Test $t) => [
                'id' => $t->id,
                'title' => $t->title,
                'visibility' => $t->visibility->value,
                'published_at' => $t->published_at?->toIso8601String(),
                'question_count' => $t->questions_count,
            ])
            ->all();
    }

    /** @return list<array<string, mixed>> */
    private static function materials(User $target): array
    {
        return Material::where('user_id', $target->id)
            ->orderByDesc('created_at')->orderByDesc('id')
            ->limit(self::CONTENT_LIMIT)
            ->get()
            ->map(fn (Material $m) => [
                'id' => $m->id,
                'title' => $m->title,
                'visibility' => $m->visibility->value,
                'size_bytes' => $m->size_bytes,
                'published_at' => $m->published_at?->toIso8601String(),
            ])
            ->all();
    }

    /** The rows this user RECEIVED; authored notifications are not queryable. @return list<array<string, mixed>> */
    private static function notifications(User $target): array
    {
        return $target->notifications()
            ->reorder('sequence', 'desc')
            ->limit(self::CONTENT_LIMIT)
            ->get()
            ->map(fn (DatabaseNotification $n) => [
                'type' => class_basename($n->type),
                'message' => $n->data['message'] ?? null,
                'created_at' => $n->created_at->toIso8601String(),
                'read_at' => $n->read_at?->toIso8601String(),
            ])
            ->all();
    }
}
