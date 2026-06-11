<?php

use Api\Exceptions\ResourceAlreadyExistsException;

it('should return 409 as http code', function () {
    expect(ResourceAlreadyExistsException::getHttpCode())->toBe(409);
});

it('should create with default message', function () {
    $e = ResourceAlreadyExistsException::create();

    expect($e->getMessage())->toBe('The Resource already exists.');
});

it('should create with custom resource name', function () {
    $e = ResourceAlreadyExistsException::create('Visit');

    expect($e->getMessage())->toBe('The Visit already exists.');
});
