<?php

declare(strict_types=1);

namespace Api\Data\DTOs;

use Api\Exceptions\ValidationException;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

class VisitRequestDto
{
    private function __construct(
        public readonly int $scheduleId,
        public readonly string $name,
        public readonly string $email,
        public readonly string $phone
    ) {}

    /**
     * @throws ValidationException If validation fails
     */
    public static function fromRequest(int $schedule_id, array $data): self
    {
        $visitValidator = v::key('name', v::alpha(' ')->stringType()->length(3, 255))
            ->key('email', v::email())
            ->key('phone', v::numericVal()->length(10, 11));

        try {
            $visitValidator->assert($data);
        } catch (NestedValidationException $e) {
            $errors = $e->getMessages([
                'name' => "nome deve conter apenas letras (a-z) e ' '.",
                'email' => 'email deve conter um endereço de email válido.',
                'phone' => 'telefone deve ter entre 10 e 11 dígitos, por exemplo, 11987654321.',
            ]);

            throw new ValidationException($errors);
        }

        return new self($schedule_id, $data['name'], $data['email'], $data['phone']);
    }
}
