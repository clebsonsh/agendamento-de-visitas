<?php

use Api\Data\DTOs\VisitRequestDto;
use Api\Exceptions\ResourceAlreadyExistsException;
use Api\Repositories\IVisitRepository;
use Api\Services\VisitService;

it('should create a visit', function () {
    $request = [
        'name' => 'John Doe',
        'email' => 'john.doe@example.com',
        'phone' => '1234567890',
    ];

    $visitDto = VisitRequestDto::fromRequest(
        1, $request
    );

    $repository = Mockery::mock(IVisitRepository::class);
    $repository->shouldReceive('existsByScheduleId')->with(1)->andReturn(false);
    $repository->shouldReceive('create')->with($visitDto)->andReturn(true);

    $service = new VisitService($repository);
    $result = $service->create($visitDto);

    expect($result)->toBeTrue();
});

it('should throw an exception when visit already exists', function () {

    $request = [
        'name' => 'John Doe',
        'email' => 'john.doe@example.com',
        'phone' => '1234567890',
    ];

    $visitDto = VisitRequestDto::fromRequest(
        1, $request
    );

    $repository = Mockery::mock(IVisitRepository::class);
    $repository->shouldReceive('existsByScheduleId')->with(1)->andReturn(true);

    $service = new VisitService($repository);
    $service->create($visitDto);
})->throws(ResourceAlreadyExistsException::class);
