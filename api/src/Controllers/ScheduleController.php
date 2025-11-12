<?php

declare(strict_types=1);

namespace Api\Controllers;

use Api\Data\DTOs\ErrorResponseDto;
use Api\Repositories\ScheduleRepository;
use Api\Services\ScheduleService;

class ScheduleController
{
    private ScheduleService $scheduleService;

    public function __construct()
    {
        $this->scheduleService = new ScheduleService(new ScheduleRepository);
    }

    public function show(int $id)
    {
        $schedule = $this->scheduleService->getById((int) $id);

        if (empty($schedule)) {

            response()->httpCode(404)->json(new ErrorResponseDto('The schedule not found.'));
        }
        response()->json([
            'schedule' => $schedule,
        ]);
    }
}
