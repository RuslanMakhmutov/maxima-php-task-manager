<?php

namespace app\Models;

use app\Helpers\Config;
use SplObjectStorage;
use SplObserver;
use SplSubject;

/**
 * Класс для работы с пользователями
 */
class User extends Model implements SplSubject
{
    protected static string $table = 'users';
    protected static array $fields = [
        'email',
        'name',
    ];

    protected static bool $has_created_at = true;

    protected int $id;
    public string $email;
    public string $name;
    /**
     * @var string[]
     */
    protected array $roles = [];
    private SplObjectStorage $observers;

    public function __construct()
    {
        $config = Config::getInstance();
        $defaultRole = new Role($config->get('user_default_role'));
        $this->roles = [$defaultRole];

        $this->observers = new SplObjectStorage();
    }

    public static function register(string $name, string $email, string $password): static
    {
        $fields = ['email', 'name', 'password'];

        $data = [
            'email' => $email,
            'name' => $name,
            'password' => password_hash($password, PASSWORD_DEFAULT),
        ];

        return parent::create($data, $fields);
    }

    public static function findByEmail(string $email): ?static
    {
        $sql = 'SELECT * FROM ' . static::getTableName() . ' WHERE email = :email LIMIT :limit';
        $rows = static::query($sql, [
            ':email' => $email,
            ':limit' => 1
        ]);
        return $rows[0] ?? null;
    }

    public function addRole(Role $role): void
    {
        if (!in_array($role->name, $this->roles)) {
            $this->roles[] = $role->name;

            $this->notify("new role");
        }
    }

    public function hasRole(Role $role): bool
    {
        return in_array($role->name, $this->roles);
    }

    public function attach(SplObserver $observer): void
    {
        $this->observers->attach($observer);
    }

    public function detach(SplObserver $observer): void
    {
        $this->observers->detach($observer);
    }

    public function notify(string $event = ''): void
    {
        /** @var SplObserver $observer **/
        foreach ($this->observers as $observer) {
            $observer->update($this, $event);
        }
    }
}
