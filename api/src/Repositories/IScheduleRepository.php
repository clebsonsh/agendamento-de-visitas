<?php

declare(strict_types=1);

namespace Api\Repositories;

interface IScheduleRepository
{
    public function getByVehicleId(int $vehicleId);
}
