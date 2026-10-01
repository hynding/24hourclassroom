<?php

namespace App\Ai;

enum CancelOutcome
{
    case Cancelled;
    /** The lock's re-read found the row already finished; nothing was done. */
    case AlreadyTerminal;
    /** Another holder kept the lock for the whole five-second wait. */
    case Busy;
}
