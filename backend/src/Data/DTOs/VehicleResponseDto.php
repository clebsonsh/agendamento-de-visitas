<?php

declare(strict_types=1);

namespace Api\Data\DTOs;

class VehicleResponseDto
{
    public function __construct(
        public readonly int $id,
        public readonly string $image,
        public readonly string $make,
        public readonly string $model,
        public readonly string $version,
        public readonly float $price,
        public readonly string $salePoint,
    ) {}

    /**
     * @param  array<string, string|int>  $vehicle
     */
    public static function createFromArray(array $vehicle): self
    {
        return new self(
            id: (int) $vehicle['id'],
            image: (string) $vehicle['image'],
            make: (string) $vehicle['make'],
            model: (string) $vehicle['model'],
            version: (string) $vehicle['version'],
            price: ((int) $vehicle['price']) / 100,
            salePoint: (string) $vehicle['sale_point'],
        );
    }
}
