<?php

namespace App\Support;

use Illuminate\Database\Eloquent\Builder;

/**
 * Curriculum standard codes on a test or material ("3.NF.A.1", "K-ESS2-1",
 * "RL.3.2"): a teacher's planning key, and a library filter. Codes are
 * stored uppercase, trimmed and de-duplicated, so a filter can match them
 * exactly. Codes are only cited, never the standards' text.
 */
final class Standards
{
    public const MAX = 12;

    public const PATTERN = '/^[A-Z0-9][A-Z0-9.\-]{0,39}$/';

    /** @return array<string, array<int, mixed>> */
    public static function rules(): array
    {
        return [
            'standards' => ['sometimes', 'nullable', 'array', 'max:'.self::MAX],
            'standards.*' => ['string', 'max:40', function (string $attribute, mixed $value, \Closure $fail) {
                if (! is_string($value) || ! preg_match(self::PATTERN, self::code($value))) {
                    $fail('Use a standard code such as 3.NF.A.1 or K-ESS2-1.');
                }
            }],
        ];
    }

    public static function code(string $value): string
    {
        return strtoupper(trim($value));
    }

    /**
     * @param  array<int, mixed>|null  $codes
     * @return list<string>|null null when there are none
     */
    public static function normalize(?array $codes): ?array
    {
        $out = [];
        foreach ($codes ?? [] as $code) {
            if (is_string($code) && ($c = self::code($code)) !== '' && ! in_array($c, $out, true)) {
                $out[] = $c;
            }
        }

        return $out === [] ? null : $out;
    }

    /**
     * Library filter: a code, or the start of one at a dot or dash boundary
     * ("3.NF" finds "3.NF.A.1", never "3.NFX").
     */
    public static function filter(Builder $query, string $term): Builder
    {
        $code = self::code($term);
        $like = addcslashes($code, '\\%_');

        return $query->where(fn ($q) => $q
            ->whereJsonContains('standards', $code)
            ->orWhereRaw("JSON_SEARCH(standards, 'one', ?) IS NOT NULL", ["{$like}.%"])
            ->orWhereRaw("JSON_SEARCH(standards, 'one', ?) IS NOT NULL", ["{$like}-%"]));
    }

    /** @return array<string, array<int, string>> */
    public static function filterRule(): array
    {
        return ['standard' => ['nullable', 'string', 'max:40', 'regex:/^[A-Za-z0-9][A-Za-z0-9.\-]*$/']];
    }
}
