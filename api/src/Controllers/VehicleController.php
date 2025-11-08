<?php

declare(strict_types=1);

namespace Api\Controllers;

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

    public function index()
    {
        response()->json([
            'vehicles' => $this->vehicleService->getAll(),
        ]);
    }

    public function show($id)
    {
        $vehicle = $this->vehicleService->getById((int) $id);

        if (empty($vehicle)) {
            response()->httpCode(404)->json([
                'message' => 'The vehicle not found.',
            ]);
        }

        $schedules = $this->scheduleService->getByVehicleId($vehicle->id);

        response()->json([
            'vehicle' => $vehicle,
            'schedules' => $schedules,
        ]);
    }
}
