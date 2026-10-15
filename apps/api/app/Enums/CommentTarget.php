<?php

namespace App\Enums;

/**
 * What a comment can be attached to. Mirrored as COMMENT_TARGETS in
 * packages/shared. Each case is one nullable foreign key on `comments`, so
 * deleting the thing deletes its discussion with it.
 */
enum CommentTarget: string
{
    case Test = 'test';
    case Question = 'question';
    case Material = 'material';
    case Course = 'course';

    /** The `comments` column that points at this kind of target. */
    public function column(): string
    {
        return $this->value.'_id';
    }

    /** @return list<string> */
    public static function columns(): array
    {
        return array_map(fn (self $t) => $t->column(), self::cases());
    }
}
