<?php

namespace App\Services;

use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;

class TaskService
{
    public function getAll(): Collection
    {
        return Task::all();
    }

    public function store(array $data): Task
    {
        $data['status'] = false;

        $task = Task::create($data);

        return $task;
    }

    public function update(array $data, Task $task): Task
    {
        $task->update($data);

        return $task;
    }

    public function destroy(Task $task): bool
    {
        return $task->delete();
    }
}
