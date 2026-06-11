<?php

use Api\Controllers\ScheduleController;
use Api\Data\DTOs\ScheduleResponseDto;
use Api\Services\ScheduleService;
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

it('should show a schedule', function () {
    $scheduleDto = ScheduleResponseDto::createFromArray([
        'id' => 1,
        'vehicle_id' => 10,
        'scheduled_at' => '2024-01-01 10:00:00',
        'is_booked' => false,
    ]);

    $service = Mockery::mock(ScheduleService::class);
    $service->shouldReceive('getById')->with(1)->andReturn($scheduleDto);

    $controller = new ScheduleController($service);
    $controller->show(1);

    expect(true)->toBeTrue();
});
