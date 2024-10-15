<?php

namespace app\Controllers\Task;

use app\Models\Task;
use app\View;

class TaskController
{

    public function index(): void
    {
        $tasks = Task::all();
        View::render('tasks.index', ['tasks' => $tasks]);
    }

    public function read(int $id): object
    {
        $task = Task::find($id);
        View::render('tasks.read', ['task' => $task]);
    }
}
