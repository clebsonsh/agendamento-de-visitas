<?php

declare(strict_types=1);

namespace Api\Data;

use PDO;

class Db
{
    public static function createPdo(): PDO
    {
        $host = self::env('DB_HOST', '127.0.0.1');
        $port = self::env('DB_PORT', '3306');
        $database = self::env('DB_DATABASE', 'scheduling');
        $username = self::env('DB_USERNAME', 'root');
        $password = self::env('DB_PASSWORD', '');

        $dsn = "mysql:host={$host}:{$port};dbname={$database};charset=utf8mb4";

        $pdo = new PDO($dsn, $username, $password, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]);

        return $pdo;
    }

    private static function env(string $key, string $default): string
    {
        /** @var string */
        $value = $_ENV[$key] ?? $default;

        return $value;
    }
}
