<?php

declare(strict_types=1);

namespace Api\Services;

use Api\Data\Entities\VehicleEntity;
use Api\Repositories\IVehicleRepository;

class VehicleService
{
    public function __construct(private IVehicleRepository $vehicleRepository) {}

    public function getAll(): array
    {
        $results = $this->vehicleRepository->getAll();

        $vehicles = [];

        foreach ($results as $vehicle) {
            $vehicles[] = VehicleEntity::createFromArray($vehicle);
        }

        return $vehicles;
    }

    public function getById(int $id)
    {
        $result = $this->vehicleRepository->getById($id);

        if (empty($result)) {
            return [];
        }

        return VehicleEntity::createFromArray($result);
    }
}
