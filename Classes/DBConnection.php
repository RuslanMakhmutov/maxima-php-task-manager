<?php

namespace Classes;

use Exception;
use PDO;

/**
 * Класс для создания подключения к базе данных
 */
final class DBConnection
{
    /**
     * Подключение к базе данных и возврат экземпляра объекта \PDO
     * @return PDO
     * @throws Exception
     */
    public function connect(): PDO
    {
        $config = new Config();

        $dsn = "mysql:host={$config->db_host};port={$config->db_port};dbname={$config->db_name}";
        return new PDO($dsn, $config->get('db_user'), $config->get('db_password'));
    }

    /**
     * возврат экземпляра объекта DBConnection
     * @return self
     */
    public static function get(): self
    {
        return new self();
    }

    protected function __construct()
    {
    }
}
