<?php

test('the theme enums (Layout, Palette, Typeset) mirror the shared TypeScript arrays exactly, both directions', function () {
    $shared = file_get_contents(base_path('../../packages/shared/src/index.ts'));

    $pairs = [
        ['LAYOUTS', \App\Enums\Layout::class],
        ['PALETTES', \App\Enums\Palette::class],
        ['TYPESETS', \App\Enums\Typeset::class],
    ];

    foreach ($pairs as [$constName, $enumClass]) {
        // Same regex the SUBJECTS/GRADE_LEVELS test uses: the const must be a
        // TaxonomyOption-shaped array with `value:` keys, or this finds nothing.
        expect(preg_match('/export const '.$constName.':.*?\];/s', $shared, $m))
            ->toBe(1, "$constName const array not found in packages/shared");
        preg_match_all('/value:\s*[\'"]([^\'"]+)[\'"]/', $m[0], $values);

        expect($values[1])->not->toBeEmpty();
        expect($values[1])->toBe(array_column($enumClass::cases(), 'value'));
    }
});
