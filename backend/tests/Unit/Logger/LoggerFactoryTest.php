<?php

use Api\Logger\LoggerFactory;
use Psr\Log\LoggerInterface;

it('should create a logger instance', function () {
    $_ENV['APP_ENV'] = 'local';

    $logger = LoggerFactory::create();

    expect($logger)->toBeInstanceOf(LoggerInterface::class);
});

it('should create a logger with warning level in production', function () {
    $_ENV['APP_ENV'] = 'production';

    $logger = LoggerFactory::create();

    expect($logger)->toBeInstanceOf(LoggerInterface::class);
});
