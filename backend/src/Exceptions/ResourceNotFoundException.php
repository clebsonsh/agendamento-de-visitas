<?php

declare(strict_types=1);

namespace Api\Exceptions;

use Exception;

class ResourceNotFoundException extends Exception
{
    public static function getHttpCode(): int
    {
        return 404;
    }

    public static function create(string $resource = 'Resource'): self
    {
        return new self("The {$resource} not found.");
    }
}
