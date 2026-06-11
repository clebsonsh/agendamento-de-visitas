<?php

use Api\Exceptions\ValidationException;

it('should return 422 as http code', function () {
    expect(ValidationException::getHttpCode())->toBe(422);
});

it('should store errors and default message', function () {
    $errors = ['name' => 'Invalid name.'];
    $e = new ValidationException($errors);

    expect($e->getMessage())->toBe('Validation Failed');
    expect($e->getErrors())->toBe($errors);
});

it('should store errors with custom message', function () {
    $errors = ['email' => 'Invalid email.'];
    $e = new ValidationException($errors, 'Custom message');

    expect($e->getMessage())->toBe('Custom message');
    expect($e->getErrors())->toBe($errors);
});
