<?php

namespace App\Ai;

/**
 * Injected so SessionTeardown's status wait is instant in tests. A bare
 * sleep() there would add five seconds to every teardown test.
 */
interface Sleeper
{
    public function sleep(int $seconds): void;
}
