<?php

declare(strict_types=1);

namespace Api\Services;

use Api\Data\Entities\ScheduleEntity;
use Api\Repositories\IScheduleRepository;

class ScheduleService
{
    public function __construct(private IScheduleRepository $scheduleRepository) {}

    public function getByVehicleId(int $vehicleId)
    {
        $results = $this->scheduleRepository->getByVehicleId($vehicleId);

        if (empty($results)) {
            return [];
        }

        $schedules = [];

        foreach ($results as $schedule) {
            $schedules[] = ScheduleEntity::createFromArray($schedule);
        }

        return $schedules;
    }
}
