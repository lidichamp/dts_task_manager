<?php

namespace App\Services;

use App\Models\Task;
use Illuminate\Support\Facades\Log;

class TaskService
{
    /**
     * Create a new task with validated data.
     *
     * @param array $data
     * @return Task
     */
    public function createTask(array $data): Task
    {
        // Log task creation for debugging
        Log::info('Creating task', $data);

        // Use Eloquent to create and return the task
        return Task::create($data);
    }

    /**
     * Update the given task with new data.
     *
     * @param Task $task
     * @param array $data
     * @return Task
     */
    public function updateTask(Task $task, array $data): Task
    {
        // Update task fields using mass assignment
        $task->update($data);

        // Return updated instance
        return $task;
    }

    /**
     * Delete the given task from the database.
     *
     * @param Task $task The task instance to delete.
     * @return bool|null Returns true on success, false on failure, or null on soft deletes.
     */
    public function deleteTask(Task $task): ?bool
    {
        // Log deletion action
        Log::info('Deleting task', ['id' => $task->id]);

        // Delete the task from the database
        return $task->delete();
    }
}
