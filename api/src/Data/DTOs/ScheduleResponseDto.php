<?php

declare(strict_types=1);

namespace Api\Data\DTOs;

class ScheduleResponseDto
{
    public function __construct(
        public readonly int $id,
        public readonly int $vehicleId,
        public readonly string $scheduledAt,
    ) {}

    public static function createFromArray(array $schedule)
    {
        return new self(
            id: $schedule['id'],
            vehicleId: $schedule['vehicle_id'],
            scheduledAt: $schedule['scheduled_at'],
        );
    }
}
