<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Pagination\LengthAwarePaginator;
use Mockery;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $taskService;

    protected function setUp(): void
    {
        parent::setUp();

        // Mock the TaskService
        $this->taskService = Mockery::mock(TaskService::class);
        $this->app->instance(TaskService::class, $this->taskService);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        Mockery::close();
    }

    /**
     * Test the index method returns paginated tasks.
     */
    public function test_index_returns_paginated_tasks()
    {
        // Arrange
        $tasks = Task::factory()->count(15)->create();
        $paginatedTasks = new LengthAwarePaginator($tasks->take(10), 15, 10, 1);

        // Mock the TaskService to return paginated tasks
        $this->taskService
            ->shouldReceive('getAllTasks')
            ->with([
                'name' => 'like',
                'status' => 'exact',
                'created_at' => 'date_range',
            ])
            ->andReturn($paginatedTasks);

        // Act
        $response = $this->getJson('/api/v1/tasks');

        // Assert
        $response->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'message',
                'data',
                'links',
                'meta',
            ])
            ->assertJson([
                'status' => 'success',
                'message' => 'resource fetched successfully',
                'meta' => [
                    'current_page' => 1,
                    'per_page' => 10,
                    'total' => 15,
                ],
            ]);
    }

    /**
     * Test the index method applies filters correctly.
     */
    public function test_index_applies_filters_correctly()
    {
        // Arrange
        $tasks = Task::factory()->count(5)->create(['status' => 'completed']);
        $paginatedTasks = new LengthAwarePaginator($tasks, 5, 10, 1);

        // Mock the TaskService to return filtered tasks
        $this->taskService
            ->shouldReceive('getAllTasks')
            ->with([
                'name' => 'like',
                'status' => 'exact',
                'created_at' => 'date_range',
            ])
            ->andReturn($paginatedTasks);

        // Act
        $response = $this->getJson('/api/v1/tasks?status=completed');

        // Assert
        $response->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'message',
                'data',
                'links',
                'meta',
            ])
            ->assertJson([
                'status' => 'success',
                'message' => 'resource fetched successfully',
                'meta' => [
                    'total' => 5,
                ],
            ]);
    }

    /**
     * Test the index method returns an empty result when no tasks exist.
     */
    public function test_index_returns_empty_result_when_no_tasks_exist()
    {
        // Arrange
        $paginatedTasks = new LengthAwarePaginator(collect(), 0, 10, 1);

        // Mock the TaskService to return an empty result
        $this->taskService
            ->shouldReceive('getAllTasks')
            ->with([
                'name' => 'like',
                'status' => 'exact',
                'created_at' => 'date_range',
            ])
            ->andReturn($paginatedTasks);

        // Act
        $response = $this->getJson('/api/v1/tasks');

        // Assert
        $response->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'message',
                'data',
                'links',
                'meta',
            ])
            ->assertJson([
                'status' => 'success',
                'message' => 'resource fetched successfully',
                'meta' => [
                    'total' => 0,
                ],
            ]);
    }
}
