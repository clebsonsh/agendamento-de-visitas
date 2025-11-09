<?php

declare(strict_types=1);

namespace Api\Services;

use Api\Data\DTOs\VisitRequestDto;
use Api\Exceptions\ResourceAlreadyExistsException;
use Api\Repositories\IVisitRepository;

class VisitService
{
    public function __construct(private IVisitRepository $visitRepository) {}

    public function create(VisitRequestDto $visitDto)
    {
        $visitAlreadyExists = $this->visitRepository->existsByScheduleId($visitDto->scheduleId);

        if ($visitAlreadyExists) {
            throw new ResourceAlreadyExistsException;
        }

        return $this->visitRepository->create($visitDto);
    }
}
