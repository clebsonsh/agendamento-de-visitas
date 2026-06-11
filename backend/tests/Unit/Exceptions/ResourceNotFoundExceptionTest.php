<?php

use Api\Exceptions\ResourceNotFoundException;

it('should return 404 as http code', function () {
    expect(ResourceNotFoundException::getHttpCode())->toBe(404);
});

it('should create with default message', function () {
    $e = ResourceNotFoundException::create();

    expect($e->getMessage())->toBe('The Resource not found.');
});

it('should create with custom resource name', function () {
    $e = ResourceNotFoundException::create('Vehicle');

    expect($e->getMessage())->toBe('The Vehicle not found.');
});

it('should be an instance of NotFoundHttpException', function () {
    $e = ResourceNotFoundException::create();

    expect($e)->toBeInstanceOf(\Pecee\SimpleRouter\Exceptions\NotFoundHttpException::class);
});
