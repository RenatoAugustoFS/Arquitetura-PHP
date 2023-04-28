<?php

namespace App\Helper\Persistence;

use App\Helper\EnvTrait;
use PDO;

class ConnectionCreatorFactory
{
    use EnvTrait;

    private static ?PDO $instance = null;

    public static function createConnection(): PDO
    {
        if (self::$instance === null) {
            $dsn = self::getEnv('MYSQL_DB_DSN');
            $user = self::getEnv('MYSQL_DB_USER');
            $password = self::getEnv('MYSQL_DB_PASSWORD');

            self::$instance = new PDO($dsn, $user, $password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]);
        }

        return self::$instance;
    }
}
