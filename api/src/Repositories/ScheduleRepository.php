<?php

declare(strict_types=1);

namespace Api\Repositories;

use Api\Data\Db;
use PDO;

class ScheduleRepository implements IScheduleRepository
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Db::getInstance();
    }

    public function getByVehicleId(int $vehicleId): array
    {
        $stmt = $this->db->prepare(<<<'SQL'
            SELECT
                *
            FROM schedules
            WHERE vehicle_id = :vehicle_id
             AND NOT EXISTS (
                SELECT 1
                FROM visits
                WHERE schedule_id = schedules.id
             )
        SQL);

        $stmt->execute(['vehicle_id' => $vehicleId]);

        return $stmt->fetchAll() ?: [];
    }
}
