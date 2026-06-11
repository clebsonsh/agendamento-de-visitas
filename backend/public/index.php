<?php

declare(strict_types=1);

require_once __DIR__.'/../vendor/autoload.php';

use Dotenv\Dotenv;
use Pecee\SimpleRouter\SimpleRouter;

$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->safeLoad();

require_once __DIR__.'/../config/cors.php';
require_once __DIR__.'/../config/container.php';

setupCors();

bootstrapContainer();

require_once __DIR__.'/../routes.php';

SimpleRouter::start();
