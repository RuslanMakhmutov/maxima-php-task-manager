<?php

namespace App\Controllers\User;

use App\Helpers\Redirect;
use App\Models\Task;
use App\Models\User;
use App\Services\TaskService;
use App\View;

class UserController
{

    public function index(): void
    {
        $users = User::all();
        User::loadRelation(Task::class, $users);
        View::render('users.index', ['users' => $users]);
    }

    public function read(int $id): void
    {
        $user = User::find($id);
        View::render('users.read', ['user' => $user]);
    }
}
