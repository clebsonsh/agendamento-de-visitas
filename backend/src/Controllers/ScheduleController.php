<?php

declare(strict_types=1);

namespace Api\Controllers;

use Api\Container;
use Api\Data\DTOs\ErrorResponseDto;
use Api\Exceptions\ResourceNotFoundException;
use Api\Services\ScheduleService;

class ScheduleController
{
    private ScheduleService $scheduleService;

    public function __construct()
    {
        $container = Container::getInstance();
        $this->scheduleService = $container->get(ScheduleService::class);
    }

    public function show(int $id): void
    {
        try {
            $schedule = $this->scheduleService->getById((int) $id);
        } catch (ResourceNotFoundException) {
            response()->httpCode(404)->json(
                new ErrorResponseDto('The schedule not found.')
            );

            return;
        }

        response()->json([
            'schedule' => $schedule,
        ]);
    }
}
