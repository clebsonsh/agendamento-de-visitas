<?php

use Api\Data\DTOs\VisitRequestDto;
use Api\Repositories\VisitRepository;

it('should create a visit', function () {
    $dto = VisitRequestDto::fromRequest(1, [
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'phone' => '11987654321',
    ]);

    $stmt = Mockery::mock(PDOStatement::class);
    $stmt->shouldReceive('execute')->with([
        'schedule_id' => 1,
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'phone' => '11987654321',
    ])->andReturn(true);

    $pdo = Mockery::mock(PDO::class);
    $pdo->shouldReceive('prepare')->andReturn($stmt);

    $repository = new VisitRepository($pdo);
    $result = $repository->create($dto);

    expect($result)->toBeTrue();
});

it('should check if a visit exists by schedule id', function () {
    $stmt = Mockery::mock(PDOStatement::class);
    $stmt->shouldReceive('execute')->with(['schedule_id' => 1])->andReturn(true);
    $stmt->shouldReceive('fetch')->andReturn(['visit_exists' => '1']);

    $pdo = Mockery::mock(PDO::class);
    $pdo->shouldReceive('prepare')->andReturn($stmt);

    $repository = new VisitRepository($pdo);
    $result = $repository->existsByScheduleId(1);

    expect($result)->toBeTrue();
});

it('should return false when visit does not exist', function () {
    $stmt = Mockery::mock(PDOStatement::class);
    $stmt->shouldReceive('execute')->with(['schedule_id' => 99])->andReturn(true);
    $stmt->shouldReceive('fetch')->andReturn(['visit_exists' => '0']);

    $pdo = Mockery::mock(PDO::class);
    $pdo->shouldReceive('prepare')->andReturn($stmt);

    $repository = new VisitRepository($pdo);
    $result = $repository->existsByScheduleId(99);

    expect($result)->toBeFalse();
});
