<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Http\JsonResponse;

class TaskController extends Controller
{
    // DI для TaskService
    public function __construct(private TaskService $taskService)
    {}

    // Получение всех задач
    public function index(): JsonResponse
    {
        $tasks = $this->taskService->getAll();

        return response()->json([
            'message' => count($tasks) > 0 ? 'Получены все задачи' : 'Нет задач',
            'count' => count($tasks), // Счетчик всех задач
            'items' => $tasks
        ]);
    }

    // Создание 1 задачи
    public function store(StoreTaskRequest $request): JsonResponse
    {
        $task = $this->taskService->store($request->validated());

        return response()->json([
            'message' => 'Задача успешно создана',
            'data' => $task
        ], 201);
    }

    // Получение 1 задачи
    public function show(Task $task): JsonResponse
    {
        return response()->json([
            'message' => "Получена задача с id - $task->id",
            'data' => $task
        ]);
    }

    // Обновление задачи
    public function update(UpdateTaskRequest $request, Task $task): JsonResponse
    {
        $updatedTask = $this->taskService->update($request->validated(), $task);

        return response()->json([
            'message' => 'Задача успешно обновлена',
            'data' => $updatedTask
        ]);
    }

    // Удаление задачи
    public function destroy(Task $task): JsonResponse
    {
        $check = $this->taskService->destroy($task);

        // Проверка на удаление (true or false)
        if ($check) {
            return response()->json([
                'message' => 'Задача успешно удалена'
            ]);
        }

        return response()->json([
            'message' => 'Не удалось удалить задачу'
        ], 404);
    }
}
