<?php

use App\Enums\Role;

function roleMirrorSource(): string
{
    return file_get_contents(base_path('../../packages/shared/src/index.ts'));
}

/** @return list<string> */
function tsStringArray(string $source, string $const): array
{
    expect(preg_match('/export const '.$const.':[^=]*=\s*\[(.*?)\];/s', $source, $m))
        ->toBe(1, "$const not found in packages/shared");
    preg_match_all("/'([a-z_]+)'/", $m[1], $values);

    return $values[1];
}

test('ROLES mirrors the Role enum exactly, in order, with the same labels', function () {
    $shared = roleMirrorSource();
    expect(preg_match('/export const ROLES:.*?\];/s', $shared, $m))->toBe(1);
    preg_match_all("/value:\s*'([^']+)',\s*label:\s*'([^']+)'/", $m[0], $pairs, PREG_SET_ORDER);

    $ts = array_map(fn ($p) => [$p[1], $p[2]], $pairs);
    $php = array_map(fn (Role $r) => [$r->value, $r->label()], Role::cases());

    expect($ts)->toBe($php);
});

test('the Role union type names every case', function () {
    expect(preg_match('/export type Role = ([^;]+);/', roleMirrorSource(), $m))->toBe(1);
    preg_match_all("/'([a-z_]+)'/", $m[1], $values);

    expect($values[1])->toBe(array_column(Role::cases(), 'value'));
});

test('the capability lists mirror the enum allowlists', function () {
    $shared = roleMirrorSource();
    $filter = fn (callable $test) => array_values(array_map(
        fn (Role $r) => $r->value,
        array_filter(Role::cases(), $test),
    ));

    expect(tsStringArray($shared, 'REGISTRATION_ROLES'))->toBe(Role::selfAssignableValues())
        ->and(tsStringArray($shared, 'AUTHOR_ROLES'))->toBe($filter(fn (Role $r) => $r->authors()))
        ->and(tsStringArray($shared, 'PUBLIC_ROLES'))->toBe($filter(fn (Role $r) => $r->isPublic()))
        ->and(tsStringArray($shared, 'SUPPORTER_ROLES'))->toBe($filter(fn (Role $r) => $r->supportsStudents()))
        ->and(tsStringArray($shared, 'SHARE_RECIPIENT_ROLES'))->toBe($filter(fn (Role $r) => $r->receivesShares()));
});

test('the comment role lists mirror the enum allowlists', function () {
    $shared = roleMirrorSource();
    $filter = fn (callable $test) => array_values(array_map(
        fn (Role $r) => $r->value,
        array_filter(Role::cases(), $test),
    ));

    expect(tsStringArray($shared, 'COMMENTER_ROLES'))->toBe($filter(fn (Role $r) => $r->comments()))
        ->and(tsStringArray($shared, 'COMMENT_MODERATOR_ROLES'))->toBe($filter(fn (Role $r) => $r->moderatesComments()));
});

test('COMMENT_TARGETS mirrors the CommentTarget enum, in order', function () {
    expect(preg_match('/export const COMMENT_TARGETS = \[(.*?)\] as const;/s', roleMirrorSource(), $m))->toBe(1);
    preg_match_all("/'([a-z_]+)'/", $m[1], $values);

    expect($values[1])->toBe(array_column(\App\Enums\CommentTarget::cases(), 'value'));
});

test('COMMENT_MAX_LENGTH matches the controller', function () {
    expect(preg_match('/export const COMMENT_MAX_LENGTH = (\d+);/', roleMirrorSource(), $m))->toBe(1)
        ->and((int) $m[1])->toBe(\App\Http\Controllers\Api\CommentController::MAX_BODY);
});
