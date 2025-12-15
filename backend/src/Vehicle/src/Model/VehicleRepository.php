<?php

declare(strict_types=1);

namespace Loop\Vehicle\Model;

interface VehicleRepository
{
    /**
     * @return array<Vehicle>
     */
    public function getAll(): array;
}
