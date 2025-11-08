<?php

declare(strict_types=1);

namespace Api\Controllers;

use Api\Repositories\VehicleRepository;
use Api\Services\VehicleService;

class VehicleController
{
    private VehicleService $vehicleService;

    public function __construct()
    {
        $this->vehicleService = new VehicleService(new VehicleRepository);
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

        response()->json([
            'vehicle' => $vehicle,
        ]);
    }
}
