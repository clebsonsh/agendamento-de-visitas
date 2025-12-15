<?php

declare(strict_types=1);

namespace Loop\Vehicle\Infrastructure\Persistence\Doctrine\Repository;

use Doctrine\ORM\EntityRepository;
use Loop\Vehicle\Model\VehicleRepository;

class DoctrineVehicleRepository extends EntityRepository implements VehicleRepository
{
    public function getAll(): array
    {
        return $this->findAll();
    }
}
