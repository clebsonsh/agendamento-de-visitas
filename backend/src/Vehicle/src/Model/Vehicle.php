<?php

declare(strict_types=1);

namespace Loop\Vehicle\Model;

use DateTimeImmutable;

class Vehicle
{
    private int $id;
    private string $image;
    private string $make;
    private string $model;
    private string $version;
    private int $price;
    private string $salePoint;
    private DateTimeImmutable $createdAt;
    private DateTimeImmutable $updatedAt;

    public function __construct(
        int $id,
        string $image,
        string $make,
        string $model,
        string $version,
        int $price,
        string $salePoint,
        DateTimeImmutable $createdAt,
        DateTimeImmutable $updatedAt
    ) {
        $this->id = $id;
        $this->image = $image;
        $this->make = $make;
        $this->model = $model;
        $this->version = $version;
        $this->price = $price;
        $this->salePoint = $salePoint;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function getMake(): string
    {
        return $this->make;
    }

    public function getModel(): string
    {
        return $this->model;
    }

    public function getVersion(): string
    {
        return $this->version;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function getSalePoint(): string
    {
        return $this->salePoint;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): DateTimeImmutable
    {
        return $this->updatedAt;
    }
}
