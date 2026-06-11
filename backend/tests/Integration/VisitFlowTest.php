<?php

use Api\Data\Db;
use Api\Data\DTOs\VisitRequestDto;
use Api\Exceptions\ResourceAlreadyExistsException;
use Api\Exceptions\ValidationException;
use Api\Repositories\VisitRepository;
use Api\Services\VisitService;

beforeEach(function () {
    $pdo = Db::createPdo();
    $pdo->query('SELECT 1');
    $this->pdo = $pdo;
    $this->pdo->query('DELETE FROM visits');
    $this->pdo->beginTransaction();
});

afterEach(function () {
    if (isset($this->pdo) && $this->pdo->inTransaction()) {
        $this->pdo->rollBack();
    }
});

it('should create a visit end-to-end', function () {
    $repository = new VisitRepository($this->pdo);
    $service = new VisitService($repository);

    $dto = VisitRequestDto::fromRequest(1, [
        'name' => 'John Doe',
        'email' => 'john.doe@example.com',
        'phone' => '11987654321',
    ]);

    $result = $service->create($dto);

    expect($result)->toBeTrue();
});

it('should reject a duplicate visit end-to-end', function () {
    $repository = new VisitRepository($this->pdo);
    $service = new VisitService($repository);

    $dto = VisitRequestDto::fromRequest(1, [
        'name' => 'John Doe',
        'email' => 'john.doe@example.com',
        'phone' => '11987654321',
    ]);

    $service->create($dto);

    $service->create($dto);
})->throws(ResourceAlreadyExistsException::class);

it('should reject invalid name end-to-end', function () {
    $this->expectException(ValidationException::class);

    VisitRequestDto::fromRequest(1, [
        'name' => 'ab',
        'email' => 'john.doe@example.com',
        'phone' => '11987654321',
    ]);
});
