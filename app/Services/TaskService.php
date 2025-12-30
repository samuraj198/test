<?php

namespace App\Services;

use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;

class TaskService
{
    // Все задачи
    public function getAll(): Collection
    {
        return Task::all();
    }

    // Создание задач
    public function store(array $data): Task
    {
        $data['status'] = false;

        $task = Task::create($data);

        return $task;
    }

    // Обновление задачи
    public function update(array $data, Task $task): Task
    {
        $task->update($data);

        return $task;
    }

    // Удаление задачи
    public function destroy(Task $task): bool
    {
        return $task->delete();
    }
}
