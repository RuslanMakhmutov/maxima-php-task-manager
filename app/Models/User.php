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
        $defaultRole = new Role($config->user_default_role);
        $this->addRole($defaultRole);

        $this->observers = new SplObjectStorage();
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
