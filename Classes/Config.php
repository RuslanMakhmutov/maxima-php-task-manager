<?php

namespace Classes;

use Exception;

/**
 * Класс для работы с конфигурацией
 * паттерн Singleton
 */
final class Config
{
    private static ?self $instance = null;
    protected array $options = [];
    protected array $env;

    private function __construct()
    {
        // TODO считать данные из файла конфигурации в массив
        $this->env = [];

        $this->fillOptions();
    }

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    protected function fillOptions(): void
    {
        $this->options = [
            'db_host' => $this->env('DB_HOST', 'localhost'),
            'db_port' => $this->env('DB_PORT', 3306),
            'db_basename' => $this->env('DB_BASENAME', 'database'),
            'db_username' => $this->env('DB_USERNAME', 'root'),
            'db_password' => $this->env('DB_PASSWORD', 'root'),

            'user_default_role' => $this->env('USER_DEFAULT_ROLE', 'user'),
        ];
    }


    private function env(string $option, $default = null): mixed
    {
        return $this->env[$option] ?? $default;
    }

    public function get(string $option): mixed
    {
        return $this->options[$option] ?? null;
    }

    public function __get(string $option): mixed
    {
        return $this->get($option);
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
