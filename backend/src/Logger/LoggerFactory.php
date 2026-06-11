<?php

declare(strict_types=1);

namespace Api\Logger;

use Monolog\Handler\StreamHandler;
use Monolog\Level;
use Monolog\Logger;
use Psr\Log\LoggerInterface;

class LoggerFactory
{
    public static function create(): LoggerInterface
    {
        $environment = $_ENV['APP_ENV'] ?? 'production';
        $logLevel = $environment === 'local' ? Level::Debug : Level::Warning;

        $logger = new Logger('app');

        $logger->pushHandler(
            new StreamHandler(
                __DIR__.'/../../var/log/app.log',
                $logLevel,
            )
        );

        return $logger;
    }
}
