<?php

namespace App\Support;

use App\Enums\Role;
use Carbon\CarbonImmutable;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

/**
 * The neutral age screen on self-registration. For a role that screens age
 * (`Role::screensAge()`), sign-up asks the month and year of birth without
 * saying what age is wanted, and refuses anyone who may be under 13: the
 * site does not take personal information from children who sign up on
 * their own (COPPA). The answer is checked here and never stored.
 *
 * Conservative on purpose: a birth month counts as its LAST day, so a child
 * whose 13th birthday falls later in the current month is still refused.
 */
final class AgeScreen
{
    public const MIN_AGE = 13;

    public const UNDER_AGE = 'You need to be 13 or older to make your own account. Ask your teacher or a parent about other ways to use the site.';

    /** @return array<string, array<int, mixed>> */
    public static function rules(): array
    {
        $year = (int) now()->year;

        return [
            'birth_month' => ['nullable', 'integer', 'between:1,12'],
            'birth_year' => ['nullable', 'integer', 'between:'.($year - 120).','.$year],
        ];
    }

    /**
     * After the role is validated: require the answer for a screened role,
     * then refuse an under-13 one. Throws a 422 on `birth_year`.
     */
    public static function assertAllowed(Request $request, Role $role): void
    {
        if (! $role->screensAge()) {
            return;
        }
        $month = $request->integer('birth_month');
        $year = $request->integer('birth_year');
        if ($month < 1 || $month > 12 || $year < 1) {
            throw ValidationException::withMessages(['birth_year' => ['Choose the month and year you were born.']]);
        }
        if (! self::oldEnough($year, $month)) {
            throw ValidationException::withMessages(['birth_year' => [self::UNDER_AGE]]);
        }
    }

    public static function oldEnough(int $year, int $month, ?CarbonImmutable $today = null): bool
    {
        $today ??= CarbonImmutable::now();
        $thirteenth = CarbonImmutable::create($year + self::MIN_AGE, $month, 1)->endOfMonth()->startOfDay();

        return $today->startOfDay()->greaterThanOrEqualTo($thirteenth);
    }
}
