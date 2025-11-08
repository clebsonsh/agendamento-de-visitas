<?php

declare(strict_types=1);

require_once __DIR__.'/../vendor/autoload.php';

use Pecee\SimpleRouter\SimpleRouter;

require_once __DIR__.'/../routes.php';

SimpleRouter::setDefaultNamespace('\Api\Controllers');

SimpleRouter::start();
