<?php

namespace App\Support;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Validation\Rule;

/**
 * The `sort` parameter of both public libraries (tests and materials), in
 * one place so the two cannot drift. `recent` (the default) is newest
 * published first; `title` is A-Z, so a zero-padded course title
 * ("AP Biology · Week 07 · …") reads in course order. Both break ties on
 * id so pagination is stable.
 */
final class LibrarySort
{
    public const RECENT = 'recent';

    public const TITLE = 'title';

    /** @return array<int, mixed> */
    public static function rule(): array
    {
        return ['nullable', Rule::in([self::RECENT, self::TITLE])];
    }

    /** Apply a validated sort (null means the default) to a library query. */
    public static function apply(Builder $query, ?string $sort): Builder
    {
        return match ($sort ?? self::RECENT) {
            self::TITLE => $query->orderBy('title')->orderBy('id'),
            self::RECENT => $query->orderByDesc('published_at')->orderByDesc('id'),
        };
    }
}
