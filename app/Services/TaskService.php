<?php
namespace App\Services;

use App\Models\Task;
use Illuminate\Support\Collection;
use App\Helpers\QueryFilterHelper;
class TaskService
{
    private static $instance = null;

    private function __construct() {}

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getAllTasks(array $filters = []): \Illuminate\Pagination\LengthAwarePaginator
    {
        $query = Task::query();
        if (!empty($filters)) {
            $query = QueryFilterHelper::applyFilters($query, request(), $filters);
        }
        return $query->paginate(10);
    }


    public function getTaskById(int $id): ?Task
    {
        return Task::find(id: $id);
    }

    public function createTask(array $data): Task
    {
        return Task::create($data);
    }

    public function updateTask(int $id, array $data): bool
    {
        $task = Task::find($id);
        return $task ? $task->update($data) : false;
    }

    public function deleteTask(int $id): bool
    {
        $task = Task::find($id);
        return $task ? $task->delete() : false;
    }
}
