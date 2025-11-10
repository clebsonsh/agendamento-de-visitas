<?php

declare(strict_types=1);

namespace Api\Services;

use Api\Data\DTOs\VehicleResponseDto;
use Api\Repositories\IVehicleRepository;

class VehicleService
{
    public function __construct(private IVehicleRepository $vehicleRepository) {}

    public function getAll(): array
    {
        $results = $this->vehicleRepository->getAll();

        $vehicles = [];

        foreach ($results as $vehicle) {
            $vehicles[] = VehicleResponseDto::createFromArray($vehicle);
        }

        return $vehicles;
    }

    public function getById(int $id)
    {
        $result = $this->vehicleRepository->getById($id);

        if (empty($result)) {
            return [];
        }

        return VehicleResponseDto::createFromArray($result);
    }
}
