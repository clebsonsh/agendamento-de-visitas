<?php

declare(strict_types=1);

namespace Loop\Vehicle\Http\Action;

use Loop\Vehicle\Application\LoadVehicleList;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class GetVehicleList
{
    private LoadVehicleList $loadVehicleList;

    public function __construct(LoadVehicleList $loadVehicleList)
    {
        $this->loadVehicleList = $loadVehicleList;
    }

    public function handle(): JsonResponse
    {
        $vehicles = $this->loadVehicleList->execute();

        return new JsonResponse([
            'vehicles' => $vehicles,
        ], Response::HTTP_OK);
    }
}
