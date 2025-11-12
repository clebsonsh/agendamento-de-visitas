<?php

declare(strict_types=1);

namespace Api\Controllers;

use Api\Data\DTOs\ErrorResponseDto;
use Api\Data\DTOs\ScheduleResponseDto;
use Api\Exceptions\ResourceNotFoundException;
use Api\Repositories\ScheduleRepository;
use Api\Services\ScheduleService;

class ScheduleController
{
    private ScheduleService $scheduleService;

    public function __construct()
    {
        $this->scheduleService = new ScheduleService(new ScheduleRepository);
    }

    public function show(int $id): void
    {
        try {
            /** @var ScheduleResponseDto */
            $schedule = $this->scheduleService->getById((int) $id);
        } catch (ResourceNotFoundException) {
            response()->httpCode(404)->json(new ErrorResponseDto('The schedule not found.'));
            exit();
        }

        response()->json([
            'schedule' => $schedule,
        ]);
    }
}
