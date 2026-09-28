<?php

namespace App\Ai;

enum TeardownOutcome
{
    case Ran;
    /** Nothing left to clean up -- a clean finished row, or a live one. */
    case NothingToDo;
    /** Another holder kept the lock for the whole five-second wait. */
    case Busy;
}
