<?php

namespace Classes;

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

        $dsn = "mysql:host={$config->db_host};port={$config->db_port};dbname={$config->db_name}";
        return new PDO($dsn, $config->get('db_user'), $config->get('db_password'));
    }

    /**
     * возврат экземпляра объекта DBConnection
     * @return self
     */
    private static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @throws Exception
     */
    public static function get(): PDO
    {
        return self::getInstance()->connect();
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
