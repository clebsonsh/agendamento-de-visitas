<?php

declare(strict_types=1);

namespace Api\Controllers;

use Api\Data\DTOs\ErrorResponseDto;
use Api\Data\DTOs\VehicleResponseDto;
use Api\Exceptions\ResourceNotFoundException;
use Api\Repositories\ScheduleRepository;
use Api\Repositories\VehicleRepository;
use Api\Services\ScheduleService;
use Api\Services\VehicleService;

class VehicleController
{
    private VehicleService $vehicleService;

    private ScheduleService $scheduleService;

    public function __construct()
    {
        $this->vehicleService = new VehicleService(new VehicleRepository);
        $this->scheduleService = new ScheduleService(new ScheduleRepository);
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
            /** @var VehicleResponseDto */
            $vehicle = $this->vehicleService->getById((int) $id);
        } catch (ResourceNotFoundException) {
            response()->httpCode(404)->json(new ErrorResponseDto('The vehicle not found.'));
            exit();
        }

        $schedules = $this->scheduleService->getByVehicleId($vehicle->id);

        response()->json([
            'vehicle' => $vehicle,
            'schedules' => $schedules,
        ]);
    }
}
