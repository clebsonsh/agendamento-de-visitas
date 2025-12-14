<?php

declare(strict_types=1);

namespace Loop\Vehicle\Http\Action;

use Symfony\Component\HttpFoundation\JsonResponse;

class GetVehicles
{
    public function handle(): JsonResponse
    {
        return new JsonResponse(["message" => "hello world"]);
    }
}
