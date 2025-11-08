<?php

declare(strict_types=1);

namespace Api\Data\Entities;

use DateTime;

class ScheduleEntity
{
    public function __construct(
        public int $id,
        public int $vehicleId,
        public DateTime $scheduledAt,
        public bool $isBooked,
    ) {}
}
