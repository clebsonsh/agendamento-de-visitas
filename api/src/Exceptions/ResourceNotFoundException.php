<?php

declare(strict_types=1);

namespace Api\Exceptions;

use Exception;

class ResourceNotFoundException extends Exception
{
    public function __construct(string $message = 'Resource not found')
    {
        parent::__construct($message);
    }
}
