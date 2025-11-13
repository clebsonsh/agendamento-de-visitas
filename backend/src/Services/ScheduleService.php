<?php

declare(strict_types=1);

namespace Api\Services;

use Api\Data\DTOs\ScheduleResponseDto;
use Api\Exceptions\ResourceNotFoundException;
use Api\Repositories\IScheduleRepository;
use DateTime;

class ScheduleService
{
    public function __construct(private IScheduleRepository $scheduleRepository) {}

    /**
     * @throws ResourceNotFoundException
     */
    public function getById(int $id): ScheduleResponseDto
    {
        /** @var array<string, bool|int|string> */
        $result = $this->scheduleRepository->getById($id);

        if (empty($result)) {
            throw new ResourceNotFoundException;
        }

        return ScheduleResponseDto::createFromArray($result);
    }

    /**
     * @return array<string, array<int, ScheduleResponseDto>>
     */
    public function getByVehicleId(int $vehicleId): array
    {
        /** @var array<int, array<string, bool|int|string>> */
        $results = $this->scheduleRepository->getByVehicleId($vehicleId);

        if (empty($results)) {
            return [];
        }

        $schedules = [];

        foreach ($results as $request) {
            $schedule = ScheduleResponseDto::createFromArray($request);
            $day = (new DateTime($schedule->scheduledAt))->format('Y-m-d');
            $schedules[$day][] = $schedule;
        }

        return $schedules;
    }
}
