<?php

declare(strict_types=1);

namespace Api\Data\DTOs;

class ScheduleResponseDto
{
    public function __construct(
        public readonly int $id,
        public readonly int $vehicleId,
        public readonly string $scheduledAt,
        public readonly bool $isBooked,
    ) {}

    /**
     * @param  array<string, string|int|bool>  $schedule
     */
    public static function createFromArray(array $schedule): self
    {
        return new self(
            id: (int) $schedule['id'],
            vehicleId: (int) $schedule['vehicle_id'],
            scheduledAt: (string) $schedule['scheduled_at'],
            isBooked: (bool) $schedule['is_booked'],
        );
    }
}
