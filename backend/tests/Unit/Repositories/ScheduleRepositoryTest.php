<?php

use Api\Repositories\ScheduleRepository;

it('should fetch a schedule by id', function () {
    $stmt = Mockery::mock(PDOStatement::class);
    $stmt->shouldReceive('execute')->with(['id' => 1])->andReturn(true);
    $stmt->shouldReceive('fetch')->andReturn([
        'id' => 1,
        'vehicle_id' => 10,
        'scheduled_at' => '2024-01-01 10:00:00',
        'is_booked' => 0,
    ]);

    $pdo = Mockery::mock(PDO::class);
    $pdo->shouldReceive('prepare')->andReturn($stmt);

    $repository = new ScheduleRepository($pdo);
    $result = $repository->getById(1);

    expect($result)->toBe([
        'id' => 1,
        'vehicle_id' => 10,
        'scheduled_at' => '2024-01-01 10:00:00',
        'is_booked' => 0,
    ]);
});

it('should return empty array when schedule not found', function () {
    $stmt = Mockery::mock(PDOStatement::class);
    $stmt->shouldReceive('execute')->with(['id' => 99])->andReturn(true);
    $stmt->shouldReceive('fetch')->andReturn(false);

    $pdo = Mockery::mock(PDO::class);
    $pdo->shouldReceive('prepare')->andReturn($stmt);

    $repository = new ScheduleRepository($pdo);
    $result = $repository->getById(99);

    expect($result)->toBe([]);
});

it('should fetch schedules by vehicle id', function () {
    $stmt = Mockery::mock(PDOStatement::class);
    $stmt->shouldReceive('execute')->with(['vehicle_id' => 1])->andReturn(true);
    $stmt->shouldReceive('fetchAll')->andReturn([
        [
            'id' => 1,
            'vehicle_id' => 1,
            'scheduled_at' => '2024-01-01 10:00:00',
            'is_booked' => 0,
        ],
    ]);

    $pdo = Mockery::mock(PDO::class);
    $pdo->shouldReceive('prepare')->andReturn($stmt);

    $repository = new ScheduleRepository($pdo);
    $result = $repository->getByVehicleId(1);

    expect($result)->toHaveCount(1);
});

it('should return empty array when no schedules for vehicle', function () {
    $stmt = Mockery::mock(PDOStatement::class);
    $stmt->shouldReceive('execute')->with(['vehicle_id' => 99])->andReturn(true);
    $stmt->shouldReceive('fetchAll')->andReturn([]);

    $pdo = Mockery::mock(PDO::class);
    $pdo->shouldReceive('prepare')->andReturn($stmt);

    $repository = new ScheduleRepository($pdo);
    $result = $repository->getByVehicleId(99);

    expect($result)->toBe([]);
});
