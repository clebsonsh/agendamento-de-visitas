<?php

use Api\Data\DTOs\ErrorResponseDto;

it('should create an ErrorResponseDto with only a message', function () {
    $dto = new ErrorResponseDto('An error occurred.');

    expect($dto->message)->toBe('An error occurred.')
        ->and($dto->errors)->toBe([]);
});

it('should create an ErrorResponseDto with a message and errors', function () {
    $errors = ['field' => 'The field is required.'];
    $dto = new ErrorResponseDto('Validation failed.', $errors);

    expect($dto->message)->toBe('Validation failed.')
        ->and($dto->errors)->toBe($errors);
});

it('should json serialize with only a message', function () {
    $dto = new ErrorResponseDto('An error occurred.');
    $serialized = $dto->jsonSerialize();

    expect($serialized)->toBe(['message' => 'An error occurred.']);
});

it('should json serialize with a message and errors', function () {
    $errors = ['field' => 'The field is required.'];
    $dto = new ErrorResponseDto('Validation failed.', $errors);
    $serialized = $dto->jsonSerialize();

    expect($serialized)->toBe([
        'message' => 'Validation failed.',
        'errors' => $errors,
    ]);
});
