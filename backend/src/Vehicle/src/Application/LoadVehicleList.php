<?php

declare(strict_types=1);

namespace Loop\Vehicle\Application;

use Loop\Vehicle\Application\Dto\VehicleResposeDto;
use Loop\Vehicle\Model\Vehicle;
use Loop\Vehicle\Model\VehicleRepository;

class LoadVehicleList
{
    private VehicleRepository $vehicleRepository;

    public function __construct(VehicleRepository $vehicleRepository)
    {
        $this->vehicleRepository = $vehicleRepository;
    }

    public function execute()
    {
        return array_map(
            fn (Vehicle $vehicle) => new VehicleResposeDto(
                $vehicle->getId(),
                $vehicle->getImage(),
                $vehicle->getMake(),
                $vehicle->getModel(),
                $vehicle->getVersion(),
                $vehicle->getPrice() / 100,
                $vehicle->getSalePoint(),
            ),
            $this->vehicleRepository->getAll()
        );
    }
}
