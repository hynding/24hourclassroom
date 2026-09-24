<?php

namespace App\Ai;

class SystemSleeper implements Sleeper
{
    public function sleep(int $seconds): void
    {
        sleep($seconds);
    }
}
