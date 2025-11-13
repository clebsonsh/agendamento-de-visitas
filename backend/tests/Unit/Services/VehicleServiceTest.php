<?php

use Api\Data\DTOs\VehicleResponseDto;
use Api\Exceptions\ResourceNotFoundException;
use Api\Repositories\IVehicleRepository;
use Api\Services\VehicleService;

it('should return a list of vehicles', function () {
    $repository = Mockery::mock(IVehicleRepository::class);
    $repository->shouldReceive('getAll')->andReturn([
        [
            'id' => 1,
            'image' => 'fake-url1.png',
            'make' => 'Make 1',
            'brand' => 'Brand 1',
            'model' => 'Model 1',
            'version' => 'Version 1',
            'price' => 10000,
            'sale_point' => 'Sale Point 1',
        ],
        [
            'id' => 2,
            'image' => 'fake-url2.png',
            'make' => 'Make 2',
            'brand' => 'Brand 2',
            'model' => 'Model 2',
            'version' => 'Version 2',
            'price' => 20000,
            'sale_point' => 'Sale Point 2',
        ],
    ]);

    $service = new VehicleService($repository);
    $vehicles = $service->getAll();

    expect($vehicles)->toBeArray()
        ->and($vehicles)->toHaveCount(2)
        ->and($vehicles[0])->toBeInstanceOf(VehicleResponseDto::class);
});

it('should return a vehicle by id', function () {
    $repository = Mockery::mock(IVehicleRepository::class);
    $repository->shouldReceive('getById')->with(1)->andReturn([
        'id' => 1,
        'image' => 'fake-url1.png',
        'make' => 'Make 1',
        'brand' => 'Brand 1',
        'model' => 'Model 1',
        'version' => 'Version 1',
        'price' => 10000,
        'sale_point' => 'Sale Point 1',
    ]);

    $service = new VehicleService($repository);
    $vehicle = $service->getById(1);

    expect($vehicle)->toBeInstanceOf(VehicleResponseDto::class)
        ->and($vehicle->id)->toBe(1);
});

it('should throw an exception when vehicle not found', function () {
    $repository = Mockery::mock(IVehicleRepository::class);
    $repository->shouldReceive('getById')->with(1)->andReturn([]);

    $service = new VehicleService($repository);
    $service->getById(1);
})->throws(ResourceNotFoundException::class);
