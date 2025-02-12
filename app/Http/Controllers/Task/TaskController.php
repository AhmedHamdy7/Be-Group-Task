<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;
use App\Http\Requests\Task\StoreTaskRequest;
use App\Http\Requests\Task\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use App\Services\TaskService;
use Illuminate\Http\JsonResponse;
use App\Models\Task;
class TaskController extends  ApiController
{

    private $taskService;

    public function __construct()
    {
        $this->taskService = TaskService::getInstance();
    }
    public function index(): JsonResponse
    {
        $tasks = $this->taskService->getAllTasks([
            'name' => 'like',
            'status' => 'exact',
            'created_at' => 'date_range',
        ]);
        return $this->okWithPagination(TaskResource::collection($tasks), $tasks);
        }
        public function show(int $id): JsonResponse
        {
            try {
                $task = $this->taskService->getTaskById($id);
                if (!$task) {
                    return $this->notFound('Task not found');
                }
                return $this->ok(new TaskResource($task), "Task retrieved successfully.");
            } catch (\Exception $e) {
                return $this->error('An error occurred while fetching the task');
            }
        }

    public function store(StoreTaskRequest $request): JsonResponse
    {
        $task = $this->taskService->createTask($request->validated());
        return $this->created(new TaskResource($task), 'Task created successfully');
    }

    public function update(UpdateTaskRequest $request, int $id): JsonResponse
{
    try {
        $task = $this->taskService->getTaskById($id);
        if (!$task) {
            return $this->notFound('Task not found');
        }
        $task->update($request->validated());
        return $this->ok(new TaskResource($task), 'Task updated successfully');
    } catch (\Exception $e) {
        return $this->error('An error occurred while updating the task');
    }
}

    public function destroy(int $id): JsonResponse
    {
        $deleted = $this->taskService->deleteTask($id);
        return $deleted ? $this->deleted('Task deleted successfully') : $this->notFound('Task not found');
    }
}
