<?php

declare(strict_types=1);

namespace Api\Data\Entities;

use DateTime;

class ScheduleEntity
{
    public function __construct(
        public readonly int $id,
        public readonly int $vehicleId,
        public readonly DateTime $scheduledAt,
        public readonly bool $isBooked,
    ) {}

    public static function createFromArray(array $schedule)
    {
        return new self(
            id: $schedule['id'],
            vehicleId: $schedule['vehicle_id'],
            scheduledAt: new DateTime($schedule['scheduled_at']),
            isBooked: (bool) $schedule['is_booked'],
        );
    }
}
