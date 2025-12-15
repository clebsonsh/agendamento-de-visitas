<?php

declare(strict_types=1);

namespace Loop\Vehicle\Infrastructure\Persistence\Doctrine\Repository;

use Doctrine\ORM\EntityRepository;
use Loop\Vehicle\Model\VehicleRepository;
use Loop\Vehicle\Model\Vehicle;

/**
 * @extends EntityRepository<Vehicle>
 */
class DoctrineVehicleRepository extends EntityRepository implements VehicleRepository
{
    /**
     * @return array<Vehicle>
     */
    public function getAll(): array
    {
        return $this->findAll();
    }
}
