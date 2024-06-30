<?php

namespace App\presentation\exception;

use Exception;

class ValidationException extends Exception
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
