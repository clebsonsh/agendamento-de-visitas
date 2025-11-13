<?php

declare(strict_types=1);

namespace Api\Repositories;

use Api\Data\DTOs\VisitRequestDto;

interface IVisitRepository
{
    public function create(VisitRequestDto $visitDto): bool;

    public function existsByScheduleId(int $scheduleId): bool;
}
