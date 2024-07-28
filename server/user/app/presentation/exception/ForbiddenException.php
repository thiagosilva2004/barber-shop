<?php

namespace app\presentation\exception;

use Exception;

abstract class ForbiddenException extends Exception
{
    public function __construct(
        protected string $message_fallback,
        protected string $message_error_code
    )
    {
        parent::__construct($message_fallback);
    }

    public function getMessageErrorCode(): string
    {
        return $this->message_error_code;
    }
}
