<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Gets all tasks.
     */
    public function index()
    {
        return response()->json(Task::all());
    }

    /**
     * Store a newly created task in storage.
     *
     * Validates the request and creates a new Task record.
     * Returns a JSON response with HTTP 201 (Created) on success.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // Validate the incoming request data with rules
        // Only 'title'. 'status' and 'due_date' are required
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'assigned_to' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:pending,in_progress,completed', 
            'due_date' => 'required|date|after_or_equal:today', // due date must not be in the past
        ]);

        // Create a new task record in the database using the validated data
        $task = Task::create($data);

        // Return a JSON response with the task and a 201 status code (created)
        return response()->json([
            'message' => 'Task created successfully.',
            'task' => $task
        ], 201);
    }



    /**
     * Display the specified task.
     *
     * @param Task $task The task model is automatically injected via route model binding.
     * @return \Illuminate\Http\JsonResponse A JSON response with the task data.
     */
    public function show($id)
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json([
                'message' => 'Task not found.'
            ], 404);
        }

        return response()->json([
            'message' => 'Task retrieved successfully.',
            'task' => $task
        ], 200);
}


    /**
     * Update the specified task's status.
     *
     * @param \Illuminate\Http\Request $request The incoming HTTP request containing form data.
     * @param Task $task The task to be updated, injected via route model binding.
     * @return \Illuminate\Http\JsonResponse A JSON response confirming the update.
     */
    public function updateStatus(Request $request, Task $task)
    {
        // Validate the incoming request — only accept specific status values
        $validated = $request->validate([
            'status' => 'required|in:pending,in_progress,completed'
        ]);

    // Apply the validated status update to the task
    $task->update($validated);

    // Return a 200 OK response with a message and the updated task data
    return response()->json([
        'message' => 'Task updated successfully.',
        'task' => $task
    ], 200);
}



     /**
     * Delete a specified task.
     * @param Task $task The task model is automatically injected via route model binding.
     * @return \Illuminate\Http\JsonResponse A JSON response with the task data.
     */
    public function destroy($id)
    {
        Task::findOrFail($id)->delete();
        return response()->json(['message' => 'Task deleted successfully']);
    }
}
