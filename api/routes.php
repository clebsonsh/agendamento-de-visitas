<?php

declare(strict_types=1);

use Api\Data\Db;
use Pecee\Http\Request;
use Pecee\SimpleRouter\SimpleRouter as Router;

/** @todo allow only requests from our front-end */
header('Access-Control-Allow-Origin: *');

Router::get('/', function () {
    $db = Db::getInstance();

    $result = $db->query(<<<'SQL'
        SELECT * FROM vehicles;
    SQL)->fetchAll();

    response()->json([
        'vehicles' => $result,
    ]);
});

Router::error(function (Request $request, \Exception $exception) {
    switch ($exception->getCode()) {
        case 404:
            $path = $request->getUrl()->getPath();
            response()->httpCode(404)->json([
                'message' => 'The route not found.',
            ]);
        case 403:
            response()->redirect('/forbidden');
    }
});
