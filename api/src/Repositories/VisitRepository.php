<?php

declare(strict_types=1);

namespace Api\Repositories;

use Api\Data\Db;
use Api\Data\DTOs\VisitRequestDto;
use PDO;

class VisitRepository implements IVisitRepository
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Db::getInstance();
    }

    public function create(VisitRequestDto $visitDto): bool
    {
        $stmt = $this->db->prepare(<<<'SQL'
            INSERT INTO visits
            (schedule_id, name, email, phone)
            VALUES (:schedule_id, :name, :email, :phone);
        SQL);

        return $stmt->execute([
            'schedule_id' => $visitDto->scheduleId,
            'name' => $visitDto->name,
            'email' => $visitDto->email,
            'phone' => $visitDto->phone,
        ]);
    }

    public function existsByScheduleId(int $scheduleId): bool
    {
        $stmt = $this->db->prepare(<<<'SQL'
            SELECT EXISTS(
                SELECT 1
                FROM visits
                WHERE schedule_id = :schedule_id
            ) AS visit_exists
        SQL);

        $stmt->execute(['schedule_id' => $scheduleId]);

        return (bool) $stmt->fetch()['visit_exists'];
    }
}
