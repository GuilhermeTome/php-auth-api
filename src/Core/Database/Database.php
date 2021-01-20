<?php

namespace Core\Database;

use Medoo\Medoo;
use PDO;

class Database
{
    private static $instance;

    /**
     * 
     * @return Medoo
     */
    public static function getInstance(): Medoo
    {
        if (!isset(self::$instance)) {
            self::$instance = new Medoo([
                'database_type' => DB_TYPE,
                'database_name' => DB_NAME,
                'server' => DB_HOST,
                'username' => DB_USER,
                'password' => DB_PWD,
                'port' => DB_PORT,
                'charset' => DB_CHARSET,
                'option' => [
                    PDO::ATTR_CASE => PDO::CASE_NATURAL,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                ]
            ]);
        }

        return self::$instance;
    }
}
