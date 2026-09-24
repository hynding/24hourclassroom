<?php

namespace App\Ai\Exceptions;

use RuntimeException;

/** 400/401/403/404/409/422: the request or the credential is wrong. */
class AnthropicRejected extends RuntimeException
{
    public function __construct(string $message, public readonly int $status)
    {
        parent::__construct($message);
    }
}
