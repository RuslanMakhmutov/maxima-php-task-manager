<?php

namespace App\Helpers;

use Exception;
use PDO;

/**
 * Класс для создания подключения к базе данных
 *  паттерн Singleton
 */
final class DBConnection
{
    private static ?self $instance = null;

    /**
     * Подключение к базе данных и возврат экземпляра объекта \PDO
     * @return PDO
     * @throws Exception
     */
    public function connect(): PDO
    {
        $config = Config::getInstance();

        $dsn = "{$config->get('db_connection')}:host={$config->get('db_host')};port={$config->get('db_port')};dbname={$config->get('db_basename')}";
        return new PDO($dsn, $config->get('db_username'), $config->get('db_password'));
    }

    /**
     * возврат экземпляра объекта DBConnection
     * @return self
     */
    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    protected function __construct()
    {
    }

    private function __clone()
    {
    }

    /**
     * @throws Exception
     */
    public function __wakeup()
    {
        throw new Exception("Cannot unserialize singleton");
    }
}
