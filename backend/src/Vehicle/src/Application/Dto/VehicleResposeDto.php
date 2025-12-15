<?php

declare(strict_types=1);

namespace Loop\Vehicle\Application\Dto;

class VehicleResposeDto
{
    public int $id;
    public string $image;
    public string $make;
    public string $model;
    public string $version;
    public float $price;
    public string $salePoint;

    public function __construct(
        int $id,
        string $image,
        string $make,
        string $model,
        string $version,
        float $price,
        string $salePoint
    ) {
        $this->id = $id;
        $this->image = $image;
        $this->make = $make;
        $this->model = $model;
        $this->version = $version;
        $this->price = $price;
        $this->salePoint = $salePoint;
    }
}
