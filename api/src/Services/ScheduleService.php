<?php

declare(strict_types=1);

namespace Api\Services;

use Api\Data\Entities\ScheduleEntity;
use Api\Repositories\IScheduleRepository;
use DateTime;

class ScheduleService
{
    public function __construct(private IScheduleRepository $scheduleRepository) {}

    public function getByVehicleId(int $vehicleId)
    {
        $data = $this->scheduleRepository->getByVehicleId($vehicleId);

        if (empty($data)) {
            return [];
        }

        $schedules = [];

        foreach ($data as $schedule) {
            $schedules[] = new ScheduleEntity(
                id: $schedule['id'],
                vehicleId: $schedule['vehicle_id'],
                scheduledAt: new DateTime($schedule['scheduled_at']),
                isBooked: (bool) $schedule['is_booked'],
            );
        }

        return $schedules;
    }
}
