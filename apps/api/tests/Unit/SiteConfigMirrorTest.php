<?php

use App\Models\SiteSetting;

/**
 * DEFAULT_SITE in packages/shared must equal SiteSetting::config() on a
 * fresh row, so a renamed or re-typed field fails here, not in a browser.
 * The nested TS literal is read group by group ("identity: { ... }") so the
 * regexes do not depend on how the object is formatted.
 */
function sharedSource(): string
{
    return file_get_contents(base_path('../../packages/shared/src/index.ts'));
}

/** @return array<string, mixed> the `key: value` pairs of one TS object body */
function tsPairs(string $body): array
{
    preg_match_all('/([\w-]+):\s*(\'[^\']*\'|null|true|false)/', $body, $m, PREG_SET_ORDER);
    $out = [];
    foreach ($m as [, $key, $value]) {
        $out[$key] = match ($value) {
            'null' => null,
            'true' => true,
            'false' => false,
            default => trim($value, "'"),
        };
    }

    return $out;
}

test('DEFAULT_THEME mirrors a fresh row theme', function () {
    expect(preg_match('/export const DEFAULT_THEME[^=]*=\s*\{(.*?)\};/s', sharedSource(), $m))->toBe(1, 'DEFAULT_THEME not found');

    expect(tsPairs($m[1]))->toBe(SiteSetting::current()->config()['theme']);
});

test('DEFAULT_SITE mirrors a fresh row, group by group', function () {
    $shared = sharedSource();
    expect(preg_match('/export const DEFAULT_SITE[^=]*=\s*\{/', $shared, $start, PREG_OFFSET_CAPTURE))->toBe(1, 'DEFAULT_SITE not found');
    $block = substr($shared, $start[0][1]);
    $config = SiteSetting::current()->config();

    expect(array_keys($config))->toBe(['theme', 'identity', 'registration', 'banner']);
    // `theme: DEFAULT_THEME` is a reference, covered by the test above.
    expect($block)->toContain('theme: DEFAULT_THEME');

    foreach (['identity', 'registration', 'banner'] as $group) {
        expect(preg_match("/{$group}:\s*\{([^}]*)\}/", $block, $m))->toBe(1, "{$group} not found in DEFAULT_SITE");
        expect(tsPairs($m[1]))->toBe($config[$group], $group);
    }
});
