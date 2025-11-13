<?php

declare(strict_types=1);

namespace Api\Data;

use Dotenv\Dotenv;
use PDO;
use PDOException;

class Db
{
    private static PDO $instace;

    protected function __construct()
    {
        $dotenv = Dotenv::createImmutable(dirname(__DIR__, 2));
        $dotenv->safeLoad();

        /** @var string */
        $host = $_ENV['DB_HOST'];
        /** @var string */
        $port = $_ENV['DB_PORT'];
        /** @var string */
        $database = $_ENV['DB_DATABASE'];
        /** @var string */
        $username = $_ENV['DB_USERNAME'];
        /** @var string */
        $password = $_ENV['DB_PASSWORD'];

        $dsn = "mysql:host={$host}:{$port};dbname={$database};charset=utf8mb4";

        try {
            $pdo = new PDO($dsn, $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$instace = $pdo;
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

    protected function __clone() {}

    public static function getInstance(): PDO
    {
        if (! isset(self::$instace)) {
            new self;
        }

        return self::$instace;
    }
}
