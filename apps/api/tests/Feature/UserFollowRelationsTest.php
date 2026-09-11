<?php

use App\Models\Follow;
use App\Models\User;

test('following and followers are distinct, not mirrored', function () {
    $a = User::factory()->create();
    $b = User::factory()->create(['role' => 'teacher']);

    // Asymmetric fixture: A follows B, nobody follows A. A swap of the pivot
    // keys in following()/followers() would pass a symmetric (A<->B) fixture
    // but fail this one.
    Follow::create(['follower_id' => $a->id, 'followed_id' => $b->id]);

    expect($a->following->pluck('id'))->toEqual(collect([$b->id]))
        ->and($a->followers)->toBeEmpty()
        ->and($b->followers->pluck('id'))->toEqual(collect([$a->id]))
        ->and($b->following)->toBeEmpty();
});
