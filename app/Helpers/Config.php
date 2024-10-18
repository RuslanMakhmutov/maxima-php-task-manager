<?php

namespace App\Helpers;

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
        $this->loadEnv();

        $this->fillOptions();

        // var_dump($this->options);
    }

    private function loadEnv(): void
    {
        $file_path = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '.env';
        if (!file_exists($file_path)) {
            die("File .env not found!");
        }

        $env = file_get_contents($file_path);

        $lines = explode("\n", $env);

        foreach($lines as $line){
            preg_match("/([^#]+)=(.*)/", $line, $matches);
            if(isset($matches[2])){
                putenv(trim($line));
            }
        }

        $this->env = getenv();
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
            'app_name' => $this->env('APP_NAME', 'Application'),
            'app_url' => $this->env('APP_URL', 'http://localhost'),

            'db_connection' => $this->env('DB_CONNECTION', 'mysql'),
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
        return trim($this->env[$option], '\'"') ?? $default;
    }

    public function get(string $option): mixed
    {
        return $this->options[$option] ?? null;
    }

    public static function option(string $option): mixed
    {
        $config = self::getInstance();
        return $config->get($option) ?? null;
    }

    // public function __get(string $option): mixed
    // {
    //     return $this->get($option);
    // }

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
