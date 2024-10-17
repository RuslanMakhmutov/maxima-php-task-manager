<?php

namespace app\Controllers\Task;

use app\Helpers\Redirect;
use app\Models\Task;
use app\Services\TaskService;
use app\View;

class TaskController
{

    public function index(): void
    {
        $tasks = Task::all();
        View::render('tasks.index', ['tasks' => $tasks]);
    }

    public function add(): void
    {
        View::render('tasks.add', [
            'tasks' => TaskService::getTree(Task::all()),
        ]);
    }

    public function create(...$data): void
    {
        $data['parent_id'] = !empty($data['parent_id']) ? $data['parent_id'] : null;
        $data['created_at'] = date('Y-m-d H:i:s');
        // TODO
        $data['user_id'] = 1;
        $task = Task::create($data);

        Redirect::to('/tasks/read?id=' . $task->getId());
    }

    public function read(int $id): void
    {
        $task = Task::find($id);
        View::render('tasks.read', ['task' => $task]);
    }

    public function edit(int $id): void
    {
        $task = Task::find($id);
        View::render('tasks.edit', [
            'task' => $task,
            'tasks' => TaskService::getTree(Task::all()),
        ]);
    }

    public function update(int $id, ...$data): void
    {
        $data['parent_id'] = !empty($data['parent_id']) ? $data['parent_id'] : null;
        Task::update($id, $data);
        Redirect::to('/tasks/read?id=' . $id);
    }

    public function delete(int $id): void
    {
        Task::delete($id);
        Redirect::to('/tasks');
    }

    public function complete(int $id): void
    {
        $task = Task::find($id);
        $task->complete();
        Redirect::back();
    }
}
