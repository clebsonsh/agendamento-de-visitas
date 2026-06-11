<?php

declare(strict_types=1);

use Api\ClassLoader\ContainerClassLoader;
use Api\Container;
use Api\Controllers\ScheduleController;
use Api\Controllers\VehicleController;
use Api\Controllers\VisitController;
use Api\Data\Db;
use Api\Repositories\IScheduleRepository;
use Api\Repositories\IVehicleRepository;
use Api\Repositories\IVisitRepository;
use Api\Repositories\ScheduleRepository;
use Api\Repositories\VehicleRepository;
use Api\Repositories\VisitRepository;
use Api\Services\ScheduleService;
use Api\Services\VehicleService;
use Api\Services\VisitService;
use Pecee\SimpleRouter\SimpleRouter;

function bootstrapContainer(): void
{
    $container = Container::getInstance();

    $container->set(PDO::class, fn () => Db::createPdo());

    $container->set(IVehicleRepository::class, fn (Container $c) => new VehicleRepository($c->get(PDO::class)));
    $container->set(IScheduleRepository::class, fn (Container $c) => new ScheduleRepository($c->get(PDO::class)));
    $container->set(IVisitRepository::class, fn (Container $c) => new VisitRepository($c->get(PDO::class)));

    $container->set(VehicleService::class, fn (Container $c) => new VehicleService($c->get(IVehicleRepository::class)));
    $container->set(ScheduleService::class, fn (Container $c) => new ScheduleService($c->get(IScheduleRepository::class)));
    $container->set(VisitService::class, fn (Container $c) => new VisitService($c->get(IVisitRepository::class)));

    $container->set(VehicleController::class, fn (Container $c) => new VehicleController(
        $c->get(VehicleService::class),
        $c->get(ScheduleService::class),
    ));
    $container->set(ScheduleController::class, fn (Container $c) => new ScheduleController(
        $c->get(ScheduleService::class),
    ));
    $container->set(VisitController::class, fn (Container $c) => new VisitController(
        $c->get(VisitService::class),
    ));

    SimpleRouter::setCustomClassLoader(new ContainerClassLoader);
}
