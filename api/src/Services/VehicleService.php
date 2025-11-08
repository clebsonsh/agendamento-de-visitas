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
        $data = $this->vehicleRepository->getAll();

        $vehicles = [];

        foreach ($data as $vehicle) {
            $vehicles[] = new VehicleEntity(
                id: $vehicle['id'],
                image: $vehicle['image'],
                make: $vehicle['make'],
                model: $vehicle['model'],
                version: $vehicle['version'],
                price: (int) $vehicle['price'],
                salePoint: $vehicle['sale_point'],
            );
        }

        return $vehicles;
    }

    public function getById(int $id)
    {
        $vehicle = $this->vehicleRepository->getById($id);

        if (empty($vehicle)) {
            return [];
        }

        return new VehicleEntity(
            id: $vehicle['id'],
            image: $vehicle['image'],
            make: $vehicle['make'],
            model: $vehicle['model'],
            version: $vehicle['version'],
            price: (int) $vehicle['price'],
            salePoint: $vehicle['sale_point'],
        );
    }
}
