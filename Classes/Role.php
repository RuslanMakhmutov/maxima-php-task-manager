<?php

namespace Classes;

/**
 * Класс для работы с ролями
 */
class Role
{
    public string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }
}
