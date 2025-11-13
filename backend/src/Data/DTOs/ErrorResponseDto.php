<?php

declare(strict_types=1);

namespace Api\Data\DTOs;

use JsonSerializable;

class ErrorResponseDto implements JsonSerializable
{
    /**
     * @param  array<string, string>  $errors
     */
    public function __construct(
        public readonly string $message,
        public readonly array $errors = [],
    ) {}

    public function jsonSerialize(): mixed
    {
        $error['message'] = $this->message;

        if ($this->errors) {
            $error['errors'] = $this->errors;
        }

        return $error;
    }
}
