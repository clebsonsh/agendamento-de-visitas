<?php

use Api\Controllers\VehicleController;
use Api\Data\DTOs\ScheduleResponseDto;
use Api\Data\DTOs\VehicleResponseDto;
use Api\Services\ScheduleService;
use Api\Services\VehicleService;
use Pecee\Http\Response;
use Pecee\SimpleRouter\SimpleRouter;

beforeEach(function () {
    $ref = new ReflectionProperty(SimpleRouter::class, 'response');
    $ref->setAccessible(true);
    $ref->setValue(null, null);

    $this->responseMock = Mockery::mock(Response::class);
    $this->responseMock->shouldReceive('json')->andReturn();
    $ref->setValue(null, $this->responseMock);
});

it('should list vehicles', function () {
    $vehicleDto = VehicleResponseDto::createFromArray([
        'id' => 1,
        'image' => 'img.png',
        'make' => 'Make',
        'model' => 'Model',
        'version' => '1.0',
        'price' => 2500000,
        'sale_point' => 'Sale Point',
    ]);

    $vehicleService = Mockery::mock(VehicleService::class);
    $vehicleService->shouldReceive('getAll')->andReturn([$vehicleDto]);

    $scheduleService = Mockery::mock(ScheduleService::class);

    $controller = new VehicleController($vehicleService, $scheduleService);
    $controller->index();

    expect(true)->toBeTrue();
});

it('should show a vehicle with schedules', function () {
    $vehicleDto = VehicleResponseDto::createFromArray([
        'id' => 1,
        'image' => 'img.png',
        'make' => 'Make',
        'model' => 'Model',
        'version' => '1.0',
        'price' => 2500000,
        'sale_point' => 'Sale Point',
    ]);

    $scheduleDto = ScheduleResponseDto::createFromArray([
        'id' => 1,
        'vehicle_id' => 1,
        'scheduled_at' => '2024-01-01 10:00:00',
        'is_booked' => false,
    ]);

    $vehicleService = Mockery::mock(VehicleService::class);
    $vehicleService->shouldReceive('getById')->with(1)->andReturn($vehicleDto);

    $scheduleService = Mockery::mock(ScheduleService::class);
    $scheduleService->shouldReceive('getByVehicleId')->with(1)->andReturn(['2024-01-01' => [$scheduleDto]]);

    $controller = new VehicleController($vehicleService, $scheduleService);
    $controller->show('1');

    expect(true)->toBeTrue();
});
