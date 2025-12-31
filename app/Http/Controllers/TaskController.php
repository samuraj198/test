<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use function Symfony\Component\String\s;

class TaskController extends Controller
{
    // DI для TaskService
    public function __construct(private TaskService $taskService)
    {}

    // Получение всех задач
    public function index(): JsonResponse
    {
        try {
            $tasks = $this->taskService->getAll();

            return response()->json([
                'success' => true,
                'message' => count($tasks) > 0 ? 'Получены все задачи' : 'Нет задач',
                'count' => count($tasks), // Счетчик всех задач
                'items' => $tasks
            ], 200);
        } catch (QueryException $e) {
            // Вывод ошибки от БД
            return response()->json([
                'success' => false,
                'message' => 'Ошибка в базе данных'
            ], 500);
        }
    }

    // Создание 1 задачи
    public function store(StoreTaskRequest $request): JsonResponse
    {
        try {
            $task = $this->taskService->store($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Задача успешно создана',
                'data' => $task
            ], 201);
        } catch (QueryException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ошибка в базе данных'
            ], 500);
        }

    }

    // Получение 1 задачи
    public function show(int $id): JsonResponse
    {
        try {
            $task = $this->taskService->getById($id);

            return response()->json([
                'success' => true,
                'message' => "Получена задача с id - $task->id",
                'data' => $task
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Задача не найдена'
            ], 404);
        }
    }

    // Обновление задачи
    public function update(UpdateTaskRequest $request, int $id): JsonResponse
    {
        try {
            $updatedTask = $this->taskService->update($request->validated(), $id);

            return response()->json([
                'success' => true,
                'message' => 'Задача успешно обновлена',
                'data' => $updatedTask
            ]);
        } catch (QueryException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ошибка в базе данных'
            ], 500);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Задача не найдена'
            ], 404);
        }

    }

    // Удаление задачи
    public function destroy(int $id): JsonResponse
    {
        try {
            $this->taskService->destroy($id);

            return response()->json([
                'success' => true,
                'message' => 'Задача успешно удалена'
            ]);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Не удалось удалить задачу'
            ], 404);
        }
    }
}
