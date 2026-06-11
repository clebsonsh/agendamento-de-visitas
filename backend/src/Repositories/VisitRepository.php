<?php

declare(strict_types=1);

namespace Api\Repositories;

use Api\Data\DTOs\VisitRequestDto;
use PDO;

class VisitRepository implements IVisitRepository
{
    public function __construct(private readonly PDO $db) {}

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

        /** @var array<string, string> */
        $result = $stmt->fetch();

        return (bool) $result['visit_exists'];
    }
}
