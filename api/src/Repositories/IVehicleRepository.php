<?php

declare(strict_types=1);

namespace Api\Repositories;

interface IVehicleRepository
{
    public function getAll();

    public function getById(int $id);
}
