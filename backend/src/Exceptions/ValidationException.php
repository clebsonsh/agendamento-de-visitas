<?php

declare(strict_types=1);

namespace Api\Exceptions;

use Exception;

class ValidationException extends Exception
{
    /** @var array<string, string> */
    protected array $errors = [];

    /**
     * @param  array<string, string>  $errors
     * @return void
     */
    public function __construct(array $errors, string $message = 'Validation Failed')
    {
        $this->errors = $errors;
        parent::__construct($message);
    }

    /**
     * @return array<string, string>
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
}
