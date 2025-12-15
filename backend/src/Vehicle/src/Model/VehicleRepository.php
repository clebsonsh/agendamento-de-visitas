<?php

declare(strict_types=1);

namespace Loop\Vehicle\Model;

interface VehicleRepository
{
    public function getAll(): array;
}
