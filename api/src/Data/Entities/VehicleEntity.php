<?php

declare(strict_types=1);

namespace Api\Data\Entities;

class VehicleEntity
{
    public function __construct(
        public int $id,
        public string $image,
        public string $make,
        public string $model,
        public string $version,
        public int $price,
        public string $salePoint,
    ) {}
}
