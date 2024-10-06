<?php

namespace Classes;

/**
 * Класс для работы с пользователями
 */
class User
{
    protected int $id;
    public string $email;
    public string $name;
    /**
     * @var string[]
     */
    protected array $roles = [];

    public function __construct()
    {
        $config = new Config();
        $defaultRole = new Role($config->user_default_role);
        $this->addRole($defaultRole);
    }

    public function addRole(Role $role): void
    {
        if (!in_array($role->name, $this->roles)) {
            $this->roles[] = $role->name;
        }
    }

    public function hasRole(Role $role): bool
    {
        return in_array($role->name, $this->roles);
    }
}
