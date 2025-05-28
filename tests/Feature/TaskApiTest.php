<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Task;

class TaskApiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the task creation API.
     */
    public function test_can_create_task()
    {
        // Prepare mock data
        $data = [
            'title' => 'Test Task',
            'assigned_to' => 'John Doe',
            'description' => 'Test description',
            'status' => 'pending',
            'due_date' => now()->addDays(3)->toDateString(),
        ];

        // Send POST request to store a new task
        $response = $this->post('/tasks', $data);

        // Assert redirect and flash message
        $response->assertRedirect('/tasks');
        $this->assertDatabaseHas('tasks', ['title' => 'Test Task']);
    }

    /**
     * Test task update API.
     */
    public function test_can_update_task()
    {
        // Create a task using a factory
        $task = Task::factory()->create([
            'status' => 'pending'
        ]);

        // Update data
        $updateData = [
            'title' => 'Updated Task Title',
            'assigned_to' => 'Jane Doe',
            'description' => 'Updated description',
            'status' => 'in_progress',
            'due_date' => now()->addDays(5)->toDateString(),
        ];

        // Send PUT request to update the task
        $response = $this->put("/tasks/{$task->id}", $updateData);

        // Assert redirect and updated database record
        $response->assertRedirect('/tasks');
        $this->assertDatabaseHas('tasks', ['title' => 'Updated Task Title']);
    }

    /**
     * Test task listing on the web.
     */
    public function test_can_list_tasks()
    {
        // Create multiple tasks
        Task::factory()->count(5)->create();

        // Visit the task index page
        $response = $this->get('/tasks');

        // Assert that the page loads successfully
        $response->assertStatus(200);
        $response->assertSee('Tasks'); // Assuming your view has this title
    }
}
