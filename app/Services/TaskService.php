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

    public function getById(int $id): Task
    {
        return Task::findOrFail($id);
    }

    // Создание задач
    public function store(array $data): Task
    {
        if (!isset($data['status'])) {
            $data['status'] = false;
        }

        $task = Task::create($data);

        return $task;
    }

    // Обновление задачи
    public function update(array $data, int $id): Task
    {
        $task = Task::findOrFail($id);
        $task->update($data);

        return $task;
    }

    // Удаление задачи
    public function destroy(int $id): bool
    {
        $task = Task::findOrFail($id);

        return $task->delete();
    }
}
