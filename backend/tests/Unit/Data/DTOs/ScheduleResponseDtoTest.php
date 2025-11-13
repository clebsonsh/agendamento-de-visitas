<?php

use Api\Data\DTOs\ScheduleResponseDto;

it('should create a ScheduleResponseDto from an array', function () {
    $scheduleData = [
        'id' => 1,
        'vehicle_id' => 10,
        'scheduled_at' => '2024-07-30 10:00:00',
        'is_booked' => true,
    ];

    $dto = ScheduleResponseDto::createFromArray($scheduleData);

    expect($dto)->toBeInstanceOf(ScheduleResponseDto::class)
        ->and($dto->id)->toBe(1)
        ->and($dto->vehicleId)->toBe(10)
        ->and($dto->scheduledAt)->toBe('2024-07-30 10:00:00')
        ->and($dto->isBooked)->toBeTrue();
});

it('should handle different data types from array', function () {
    $scheduleData = [
        'id' => '2',
        'vehicle_id' => '20',
        'scheduled_at' => '2024-08-01 12:30:00',
        'is_booked' => 0, // falsy value
    ];

    $dto = ScheduleResponseDto::createFromArray($scheduleData);

    expect($dto->id)->toBeInt()->toBe(2)
        ->and($dto->vehicleId)->toBeInt()->toBe(20)
        ->and($dto->isBooked)->toBeBool()->toBeFalse();
});

it('should handle truthy values for is_booked', function ($isBooked, bool $expected) {
    $scheduleData = [
        'id' => 3,
        'vehicle_id' => 30,
        'scheduled_at' => '2024-09-15 15:00:00',
        'is_booked' => $isBooked,
    ];

    $dto = ScheduleResponseDto::createFromArray($scheduleData);

    expect($dto->isBooked)->toBe($expected);
})->with([
    [1, true],
    ['1', true],
    [true, true],
    [0, false],
    ['0', false],
    [false, false],
    ['', false],
]);
