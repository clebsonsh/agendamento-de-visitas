<?php

declare(strict_types=1);

namespace Api\Controllers;

use Api\Services\ScheduleService;

class ScheduleController
{
    public function __construct(
        private ScheduleService $scheduleService,
    ) {}

    public function show(int $id): void
    {
        $schedule = $this->scheduleService->getById((int) $id);

        response()->json([
            'schedule' => $schedule,
        ]);
    }
}
