<?php

declare(strict_types=1);

namespace Api\Services;

use Api\Data\DTOs\ScheduleResponseDto;
use Api\Repositories\IScheduleRepository;
use DateTime;

class ScheduleService
{
    public function __construct(private IScheduleRepository $scheduleRepository) {}

    public function getById(int $id)
    {
        $result = $this->scheduleRepository->getById($id);

        if (empty($result)) {
            return [];
        }

        return ScheduleResponseDto::createFromArray($result);
    }

    public function getByVehicleId(int $vehicleId)
    {
        $results = $this->scheduleRepository->getByVehicleId($vehicleId);

        if (empty($results)) {
            return [];
        }

        $schedules = [];

        foreach ($results as $data) {
            $shchedule = ScheduleResponseDto::createFromArray($data);
            $day = (new DateTime($shchedule->scheduledAt))->format('Y-m-d');
            $schedules[$day][] = $shchedule;
        }

        return $schedules;
    }
}
