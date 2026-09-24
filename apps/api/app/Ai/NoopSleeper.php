<?php

namespace App\Ai;

/** Bound by the fakeAnthropic() Pest helper: a teardown test must not wait. */
class NoopSleeper implements Sleeper
{
    public function sleep(int $seconds): void
    {
        //
    }
}
