<?php

declare(strict_types=1);

namespace Api\Services;

use Api\Data\DTOs\VehicleResponseDto;
use Api\Exceptions\ResourceNotFoundException;
use Api\Repositories\IVehicleRepository;

class VehicleService
{
    public function __construct(private IVehicleRepository $vehicleRepository) {}

    /**
     * @return array<int, VehicleResponseDto>
     */
    public function getAll(): array
    {
        /** @var array<int, array<string, string|int>> */
        $results = $this->vehicleRepository->getAll();

        $vehicles = [];

        foreach ($results as $vehicle) {
            $vehicles[] = VehicleResponseDto::createFromArray($vehicle);
        }

        return $vehicles;
    }

    /**
     * @throws ResourceNotFoundException
     */
    public function getById(int $id): VehicleResponseDto
    {
        /** @var array<string, string|int> */
        $result = $this->vehicleRepository->getById($id);

        if (empty($result)) {
            throw new ResourceNotFoundException;
        }

        return VehicleResponseDto::createFromArray($result);
    }
}
