<?php

declare(strict_types=1);

namespace Loop\Vehicle\Application;

use DateTimeImmutable;
use Loop\Vehicle\Application\Dto\VehicleResposeDto;
use Loop\Vehicle\Model\Vehicle;
use Loop\Vehicle\Model\VehicleRepository;
use PHPUnit\Framework\TestCase;

class LoadVehicleListTest extends TestCase
{
    private VehicleRepository $vehicleRepository;
    private LoadVehicleList $instance;

    public function setUp(): void
    {
        $this->vehicleRepository = $this->createMock(VehicleRepository::class);
        $this->instance = new LoadVehicleList($this->vehicleRepository);
    }

    public function testLoadVehicleListShouldWork(): void
    {
        $vehiclesMock = [
            new Vehicle(
                1,
                "https://fake-url.com/polo.png",
                "Volkswagen",
                "Polo",
                "TRACK 1.0 MPI FLEX 4P MANUAL (84 cv)",
                9399000,
                "São Bernardo do Campo - São Paulo",
                new DateTimeImmutable(),
                new DateTimeImmutable(),
            ),
            new Vehicle(
                2,
                "https://fake-url.com/onix.png",
                "Chevrolet",
                "Onix",
                "1.0 ASPIRADO 4P MANUAL (82 cv)",
                8499000,
                "Santo André - São Paulo",
                new DateTimeImmutable(),
                new DateTimeImmutable(),
            ),
            new Vehicle(
                1,
                "https://fake-url.com/hb20.png",
                "Hyundai",
                "HB20",
                "1.0 KAPPA 4P MANUAL (80 cv)",
                9519000,
                "São Caetano do Sul - São Paulo",
                new DateTimeImmutable(),
                new DateTimeImmutable(),
            ),
        ];

        $this->vehicleRepository
            ->expects($this->once())
            ->method('getAll')
            ->willReturn($vehiclesMock);

        $vehicles = $this->instance->execute();

        $this->assertIsArray($vehicles);
        $this->assertContainsOnlyInstancesOf(VehicleResposeDto::class, $vehicles);
    }
}
