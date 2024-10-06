<?php

namespace Classes;

/**
 * Класс для работы с задачами
 */
class Task
{
    protected int $id;
    public string $name;
    public int $user_id;

    public function __construct()
    {
    }
}
