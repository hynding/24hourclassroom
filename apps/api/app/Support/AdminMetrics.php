<?php

namespace App\Support;

use App\Enums\GenerationStatus;
use App\Enums\Role;
use App\Enums\Visibility;
use App\Models\Connection;
use App\Models\Follow;
use App\Models\Generation;
use App\Models\Material;
use App\Models\Test;
use App\Models\User;
use BackedEnum;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Cache;

/**
 * The admin dashboard's numbers. Cached for a minute: `generations` is
 * indexed on (user_id, created_at) only, so the status, cost and leftovers
 * aggregates are table scans, and an overview page can be sixty seconds
 * stale. Admin-only by the caller (DashboardController hands non-admins null).
 */
final class AdminMetrics
{
    public const CACHE_KEY = 'admin-metrics';

    public const TTL_SECONDS = 60;

    /** @return array<string, mixed> */
    public static function build(): array
    {
        return Cache::remember(self::CACHE_KEY, self::TTL_SECONDS, fn () => [
            'people' => self::people(),
            'content' => [
                'tests' => self::content(Test::query()),
                'materials' => self::content(Material::query()),
            ],
            'generations' => self::generations(),
            'recent_users' => self::recentUsers(),
        ]);
    }

    /** @return array<string, mixed> */
    private static function people(): array
    {
        $total = User::count();

        return [
            'by_role' => self::countBy(User::query(), 'role', Role::cases()),
            'verified_percentage' => $total === 0
                ? 0
                : (int) round(User::whereNotNull('email_verified_at')->count() / $total * 100),
            'new_7d' => User::where('created_at', '>=', now()->subDays(7))->count(),
            'new_30d' => User::where('created_at', '>=', now()->subDays(30))->count(),
            'unverified_7d_plus' => User::whereNull('email_verified_at')->where('created_at', '<', now()->subDays(7))->count(),
            'follows' => Follow::count(),
            'connections' => Connection::count(),
        ];
    }

    /**
     * @param  Builder<Test>|Builder<Material>  $query
     * @return array{public: int, private: int, published_30d: int}
     */
    private static function content(Builder $query): array
    {
        return [
            ...self::countBy(clone $query, 'visibility', Visibility::cases()),
            'published_30d' => (clone $query)->where('published_at', '>=', now()->subDays(30))->count(),
        ];
    }

    /** @return array<string, mixed> */
    private static function generations(): array
    {
        $byStatus = self::countBy(Generation::query(), 'status', GenerationStatus::cases());

        // From the enum, not a hand-written list: an eighth case counts as
        // whatever isTerminal() says it is.
        $live = 0;
        foreach (GenerationStatus::cases() as $case) {
            if (! $case->isTerminal()) {
                $live += $byStatus[$case->value];
            }
        }

        return [
            'by_status' => $byStatus,
            'live' => $live,
            'cost_30d' => self::cost(Generation::where('created_at', '>=', now()->subDays(30))),
            'cost_all' => self::cost(Generation::query()),
            'leftovers' => Generation::withLeftovers()->count(),
        ];
    }

    /**
     * Sums skip nulls; the nulls are counted separately so the page can say
     * "(+N unpriced)" instead of rendering an unknown cost as $0.00.
     *
     * @param  Builder<Generation>  $query
     * @return array{cents: int, unpriced: int}
     */
    private static function cost(Builder $query): array
    {
        return [
            'cents' => (int) (clone $query)->sum('list_cost_cents'),
            'unpriced' => (clone $query)->whereNull('list_cost_cents')->count(),
        ];
    }

    /**
     * One GROUP BY, zero-filled over every enum case so a new case shows up
     * as a 0 instead of vanishing. pluck() runs on the BUILDER, never on a
     * hydrated collection: a model would hand back the cast enum object as
     * the key, which PHP refuses as an array offset.
     *
     * @param  Builder<\Illuminate\Database\Eloquent\Model>  $query
     * @param  list<BackedEnum>  $cases
     * @return array<string, int>
     */
    private static function countBy(Builder $query, string $column, array $cases): array
    {
        $counts = $query->selectRaw("{$column}, count(*) as c")->groupBy($column)->pluck('c', $column);

        $out = [];
        foreach ($cases as $case) {
            $out[$case->value] = (int) ($counts[$case->value] ?? 0);
        }

        return $out;
    }

    /** @return list<array<string, mixed>> */
    private static function recentUsers(): array
    {
        return User::query()
            ->orderByDesc('created_at')
            ->orderByDesc('id')
            ->limit(10)
            ->get(['id', 'name', 'email', 'role', 'email_verified_at', 'created_at'])
            ->map(fn (User $user) => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role->value,
                'verified' => $user->hasVerifiedEmail(),
                'created_at' => $user->created_at->toIso8601String(),
            ])
            ->all();
    }
}
