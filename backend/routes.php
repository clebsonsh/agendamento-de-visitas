<?php

declare(strict_types=1);

use Api\Controllers\ScheduleController;
use Api\Controllers\VehicleController;
use Api\Controllers\VisitController;
use Api\Data\DTOs\ErrorResponseDto;
use Pecee\Http\Request;
use Pecee\SimpleRouter\Exceptions\NotFoundHttpException;
use Pecee\SimpleRouter\SimpleRouter as Router;

Router::group(['prefix' => '/api/v1/'], function () {
    Router::get('/vehicles', [VehicleController::class, 'index'])->name('vehicles.index');
    Router::get('/vehicles/{id}', [VehicleController::class, 'show'])->name('vehicles.show');

    Router::get('/schedules/{id}', [ScheduleController::class, 'show'])->name('schedules.show');

    Router::post('/schedules/{id}/visits', [VisitController::class, 'create'])->name('visits.create');
});

Router::error(function (Request $request, \Exception $exception) {
    $status = match (true) {
        $exception instanceof NotFoundHttpException => 404,
        default => 500,
    };

    response()->httpCode($status)->json(
        new ErrorResponseDto($exception->getMessage())
    );
});
