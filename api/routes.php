<?php

declare(strict_types=1);

use Api\Controllers\VehicleController;
use Pecee\Http\Request;
use Pecee\SimpleRouter\SimpleRouter as Router;

/** @todo allow only requests from our front-end */
header('Access-Control-Allow-Origin: *');

Router::group(['prefix' => '/api/v1/'], function () {
    Router::get('/vehicles', [VehicleController::class, 'index'])->name('vehicles.index');
    Router::get('/vehicles/{id}', [VehicleController::class, 'show'])->name('vehicles.show');
});

Router::error(function (Request $request, \Exception $exception) {
    switch ($exception->getCode()) {
        case 404:
            $path = $request->getUrl()->getPath();
            response()->httpCode(404)->json([
                'message' => 'The route not found.',
            ]);
        default:
            response()->httpCode(500)->json([
                'message' => 'Something went wrong.',
            ]);
    }
});
