<?php

use Api\Data\DTOs\ScheduleResponseDto;
use Api\Exceptions\ResourceNotFoundException;
use Api\Repositories\IScheduleRepository;
use Api\Services\ScheduleService;

it('should return a schedule by id', function () {
    $repository = Mockery::mock(IScheduleRepository::class);
    $repository->shouldReceive('getById')->with(1)->andReturn([
        'id' => 1,
        'vehicle_id' => 1,
        'scheduled_at' => '2024-01-01 10:00:00',
        'is_booked' => false,
    ]);

    $service = new ScheduleService($repository);
    $schedule = $service->getById(1);

    expect($schedule)->toBeInstanceOf(ScheduleResponseDto::class)
        ->and($schedule->id)->toBe(1);
});

it('should throw an exception when schedule not found', function () {
    $repository = Mockery::mock(IScheduleRepository::class);
    $repository->shouldReceive('getById')->with(1)->andReturn([]);

    $service = new ScheduleService($repository);
    $service->getById(1);
})->throws(ResourceNotFoundException::class);

it('should return a list of schedules by vehicle id', function () {
    $repository = Mockery::mock(IScheduleRepository::class);
    $repository->shouldReceive('getByVehicleId')->with(1)->andReturn([
        [
            'id' => 1,
            'vehicle_id' => 1,
            'scheduled_at' => '2024-01-01 10:00:00',
            'is_booked' => false,
        ],
        [
            'id' => 2,
            'vehicle_id' => 1,
            'scheduled_at' => '2024-01-01 11:00:00',
            'is_booked' => true,
        ],
        [
            'id' => 3,
            'vehicle_id' => 1,
            'scheduled_at' => '2024-01-02 10:00:00',
            'is_booked' => false,
        ],
    ]);

    $service = new ScheduleService($repository);
    $schedules = $service->getByVehicleId(1);

    expect($schedules)->toBeArray()
        ->and($schedules)->toHaveCount(2)
        ->and($schedules['2024-01-01'])->toHaveCount(2)
        ->and($schedules['2024-01-02'])->toHaveCount(1)
        ->and($schedules['2024-01-01'][0])->toBeInstanceOf(ScheduleResponseDto::class);
});

it('should return an empty array when no schedules found for a vehicle', function () {
    $repository = Mockery::mock(IScheduleRepository::class);
    $repository->shouldReceive('getByVehicleId')->with(1)->andReturn([]);

    $service = new ScheduleService($repository);
    $schedules = $service->getByVehicleId(1);

    expect($schedules)->toBeArray();
});
