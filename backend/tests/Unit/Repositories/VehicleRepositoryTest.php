<?php

use Api\Repositories\VehicleRepository;

it('should fetch all vehicles', function () {
    $stmt = Mockery::mock(PDOStatement::class);
    $stmt->shouldReceive('execute')->andReturn(true);
    $stmt->shouldReceive('fetchAll')->andReturn([
        ['id' => 1, 'image' => 'img.png', 'make' => 'Make', 'brand' => 'Brand', 'model' => 'Model', 'version' => '1.0', 'price' => 2500000, 'sale_point' => 'Sale Point'],
    ]);

    $pdo = Mockery::mock(PDO::class);
    $pdo->shouldReceive('prepare')->andReturn($stmt);

    $repository = new VehicleRepository($pdo);
    $result = $repository->getAll();

    expect($result)->toHaveCount(1);
});

it('should fetch vehicle by id', function () {
    $stmt = Mockery::mock(PDOStatement::class);
    $stmt->shouldReceive('execute')->with(['id' => 1])->andReturn(true);
    $stmt->shouldReceive('fetch')->andReturn([
        'id' => 1, 'image' => 'img.png', 'make' => 'Make', 'brand' => 'Brand', 'model' => 'Model', 'version' => '1.0', 'price' => 2500000, 'sale_point' => 'Sale Point',
    ]);

    $pdo = Mockery::mock(PDO::class);
    $pdo->shouldReceive('prepare')->andReturn($stmt);

    $repository = new VehicleRepository($pdo);
    $result = $repository->getById(1);

    expect($result['id'])->toBe(1);
});

it('should return empty array when vehicle not found', function () {
    $stmt = Mockery::mock(PDOStatement::class);
    $stmt->shouldReceive('execute')->with(['id' => 99])->andReturn(true);
    $stmt->shouldReceive('fetch')->andReturn(false);

    $pdo = Mockery::mock(PDO::class);
    $pdo->shouldReceive('prepare')->andReturn($stmt);

    $repository = new VehicleRepository($pdo);
    $result = $repository->getById(99);

    expect($result)->toBe([]);
});
