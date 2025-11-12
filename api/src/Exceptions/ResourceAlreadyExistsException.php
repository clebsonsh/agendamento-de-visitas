<?php

declare(strict_types=1);

namespace Api\Exceptions;

use Exception;

class ResourceAlreadyExistsException extends Exception
{
    public function __construct(string $message = 'Resource already exists')
    {
        parent::__construct($message);
    }
}
