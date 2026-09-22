<?php

namespace App\Ai\Exceptions;

use RuntimeException;

/** Transport, timeout, 408, 429 or 5xx: the same request may work later. */
class AnthropicUnavailable extends RuntimeException
{
    public function __construct(string $message, public readonly int $status)
    {
        parent::__construct($message);
    }
}
