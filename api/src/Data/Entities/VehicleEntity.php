<?php

declare(strict_types=1);

namespace Api\Data\Entities;

class VehicleEntity
{
    public function __construct(
        public readonly int $id,
        public readonly string $image,
        public readonly string $make,
        public readonly string $model,
        public readonly string $version,
        public readonly int $price,
        public readonly string $salePoint,
    ) {}

    public static function createFromArray(array $vehicle)
    {
        return new self(
            id: $vehicle['id'],
            image: $vehicle['image'],
            make: $vehicle['make'],
            model: $vehicle['model'],
            version: $vehicle['version'],
            price: (int) $vehicle['price'],
            salePoint: $vehicle['sale_point'],
        );
    }
}
