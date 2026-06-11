<?php

declare(strict_types=1);

namespace Api\Exceptions;

use Exception;

class ResourceAlreadyExistsException extends Exception
{
    public static function getHttpCode(): int
    {
        return 409;
    }

    public static function create(string $resource = 'Resource'): self
    {
        return new self("The {$resource} already exists.");
    }
}
