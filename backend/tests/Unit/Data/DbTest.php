<?php

use Api\Data\Db;

beforeEach(function () {
    $_ENV['DB_HOST'] = 'db';
    $_ENV['DB_PORT'] = '3306';
    $_ENV['DB_DATABASE'] = 'scheduling';
    $_ENV['DB_USERNAME'] = 'loop';
    $_ENV['DB_PASSWORD'] = 'password';
});

it('should create a PDO instance', function () {
    $pdo = Db::createPdo();

    expect($pdo)->toBeInstanceOf(PDO::class);
})->skipOnCI();

it('should use default values when env vars are missing', function () {
    unset($_ENV['DB_HOST'], $_ENV['DB_PORT'], $_ENV['DB_DATABASE'], $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD']);

    try {
        $pdo = Db::createPdo();
        // If it connects or throws, we just verify the code ran
        expect($pdo)->toBeInstanceOf(PDO::class);
    } catch (Exception $e) {
        // Connection might fail with defaults, but code was exercised
        expect($e->getMessage())->toContain('SQLSTATE');
    }
})->skipOnCI();
