<?php

use Api\Data\DTOs\VehicleResponseDto;

it('should create a VehicleResponseDto from an array', function () {
    $vehicleData = [
        'id' => 1,
        'image' => 'path/to/image.jpg',
        'make' => 'Test Make',
        'model' => 'Test Model',
        'version' => '1.0',
        'price' => 2500050, // Represents 25000.50
        'sale_point' => 'Test Sale Point',
    ];

    $dto = VehicleResponseDto::createFromArray($vehicleData);

    expect($dto)->toBeInstanceOf(VehicleResponseDto::class)
        ->and($dto->id)->toBe(1)
        ->and($dto->image)->toBe('path/to/image.jpg')
        ->and($dto->make)->toBe('Test Make')
        ->and($dto->model)->toBe('Test Model')
        ->and($dto->version)->toBe('1.0')
        ->and($dto->price)->toBe(25000.50)
        ->and($dto->salePoint)->toBe('Test Sale Point');
});

it('should handle different data types from array', function () {
    $vehicleData = [
        'id' => '3',
        'image' => 'path/to/string/image.jpg',
        'make' => 'String Make',
        'model' => 'String Model',
        'version' => '3.0',
        'price' => '5000000', // 50000.00 as a string
        'sale_point' => 'String Sale Point',
    ];

    $dto = VehicleResponseDto::createFromArray($vehicleData);

    expect($dto->id)->toBeInt()->toBe(3)
        ->and($dto->price)->toBeFloat()->toBe(50000.00);
});
