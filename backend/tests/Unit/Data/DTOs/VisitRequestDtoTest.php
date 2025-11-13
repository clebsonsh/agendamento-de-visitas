<?php

use Api\Data\DTOs\VisitRequestDto;
use Api\Exceptions\ValidationException;

it('should create a VisitRequestDto from request', function () {
    $request = [
        'name' => 'John Doe',
        'email' => 'john.doe@example.com',
        'phone' => '11987654321',
    ];

    $dto = VisitRequestDto::fromRequest(1, $request);

    expect($dto->scheduleId)->toBe(1)
        ->and($dto->name)->toBe('John Doe')
        ->and($dto->email)->toBe('john.doe@example.com')
        ->and($dto->phone)->toBe('11987654321');
});

it('should throw ValidationException for invalid name', function (string $name) {
    $request = [
        'name' => $name,
        'email' => 'john.doe@example.com',
        'phone' => '11987654321',
    ];

    try {
        VisitRequestDto::fromRequest(1, $request);
    } catch (ValidationException $e) {
        expect($e->getErrors())->toHaveKey('name', 'Deve conter pelo menos 3 letras e apenas letras (a-z) e espaços em branco.');
    }
})->with([
    'ab', // too short
    'John Doe 123', // contains numbers
    'John@Doe', // contains symbols
]);

it('should throw ValidationException for invalid email', function (string $email) {
    $request = [
        'name' => 'John Doe',
        'email' => $email,
        'phone' => '11987654321',
    ];

    try {
        VisitRequestDto::fromRequest(1, $request);
    } catch (ValidationException $e) {
        expect($e->getErrors())->toHaveKey('email', 'Deve conter um endereço de e-mail válido.');
    }
})->with([
    'invalid-email',
    'invalid-email@',
    'invalid-email@.com',
]);

it('should throw ValidationException for invalid phone', function (string $phone) {
    $request = [
        'name' => 'John Doe',
        'email' => 'john.doe@example.com',
        'phone' => $phone,
    ];

    try {
        VisitRequestDto::fromRequest(1, $request);
    } catch (ValidationException $e) {
        expect($e->getErrors())->toHaveKey('phone', 'Deve ter entre 10 e 11 dígitos, por exemplo, 11987654321.');
    }
})->with([
    '123456789', // too short
    '123456789012', // too long
    'abcdefghij', // not numeric
]);
