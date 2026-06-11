<?php

declare(strict_types=1);

namespace Api\Controllers;

use Api\Services\ScheduleService;
use Api\Services\VehicleService;

class VehicleController
{
    public function __construct(
        private VehicleService $vehicleService,
        private ScheduleService $scheduleService,
    ) {}

    public function index(): void
    {
        response()->json([
            'vehicles' => $this->vehicleService->getAll(),
        ]);
    }

    public function show(string $id): void
    {
        $vehicle = $this->vehicleService->getById((int) $id);

        $schedules = $this->scheduleService->getByVehicleId($vehicle->id);

        response()->json([
            'vehicle' => $vehicle,
            'schedules' => $schedules,
        ]);
    }
}
