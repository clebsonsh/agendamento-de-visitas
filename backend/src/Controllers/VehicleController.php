<?php

declare(strict_types=1);

namespace Api\Controllers;

use Api\Container;
use Api\Data\DTOs\ErrorResponseDto;
use Api\Exceptions\ResourceNotFoundException;
use Api\Services\ScheduleService;
use Api\Services\VehicleService;

class VehicleController
{
    private VehicleService $vehicleService;

    private ScheduleService $scheduleService;

    public function __construct()
    {
        $container = Container::getInstance();
        $this->vehicleService = $container->get(VehicleService::class);
        $this->scheduleService = $container->get(ScheduleService::class);
    }

    public function index(): void
    {
        response()->json([
            'vehicles' => $this->vehicleService->getAll(),
        ]);
    }

    public function show(string $id): void
    {
        try {
            $vehicle = $this->vehicleService->getById((int) $id);
        } catch (ResourceNotFoundException) {
            response()->httpCode(404)->json(
                new ErrorResponseDto('The vehicle not found.')
            );

            return;
        }

        $schedules = $this->scheduleService->getByVehicleId($vehicle->id);

        response()->json([
            'vehicle' => $vehicle,
            'schedules' => $schedules,
        ]);
    }
}
