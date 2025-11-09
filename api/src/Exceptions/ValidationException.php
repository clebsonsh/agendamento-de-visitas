<?php

declare(strict_types=1);

namespace Api\Exceptions;

use Exception;

class ValidationException extends Exception
{
    protected array $errors = [];

    public function __construct(array $errors, $message = 'Validation Failed')
    {
        $this->errors = $errors;
        parent::__construct($message);
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}
