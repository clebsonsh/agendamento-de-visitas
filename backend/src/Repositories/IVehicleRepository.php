<?php

declare(strict_types=1);

namespace Api\Repositories;

interface IVehicleRepository
{
    public function getAll(): mixed;

    public function getById(int $id): mixed;
}
