<?php

namespace Src\Services;

use PDO;
use PDOException;
use Dotenv\Dotenv;

class Database {

    private static $instance = null;

    public static function getConnection() {

        if (self::$instance === null) {
            $dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
            $dotenv->load();

            $driver = $_ENV['DB_CONNECTION'];
            $host   = $_ENV['DB_HOST'];
            $dbname = $_ENV['DB_DATABASE'];
            $user   = $_ENV['DB_USER'];
            $pass   = $_ENV['DB_PASSWORD'];

            $dsn = "{$driver}:host={$host};dbname={$dbname}";

            try {
                self::$instance = new PDO($dsn, $user, $pass);
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("ERROR: " . $e->getMessage());
            }
        }

        return self::$instance;
    }
}
