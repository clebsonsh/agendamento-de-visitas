<?php

declare(strict_types=1);

namespace Api\Repositories;

use Api\Data\Db;
use PDO;

class VehicleRepository implements IVehicleRepository
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Db::getInstance();
    }

    public function getAll(): mixed
    {
        $stmt = $this->db->prepare(<<<'SQL'
            SELECT *
            FROM vehicles
        SQL);

        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function getById(int $id): mixed
    {
        $stmt = $this->db->prepare(<<<'SQL'
            SELECT *
            FROM vehicles
            WHERE id = :id LIMIT 1
        SQL);

        $stmt->execute(['id' => $id]);

        return $stmt->fetch() ?: [];
    }
}
