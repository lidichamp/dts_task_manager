<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Services\TaskService;

class TaskController extends Controller
{
    /**
     * TaskService instance for delegating business logic
     *
     * @var TaskService
     */
    protected $taskService;

    /**
     * Inject TaskService into the controller
     */
    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    /**
     * Display a list of tasks ordered by due date.
     */
    public function index()
    {
        // Paginate the tasks to show 5 per page 
        $tasks = Task::orderBy('due_date')->paginate(5);

        // Return the view with the tasks list
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form to create a new task.
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created task in the DB
     */
    public function store(StoreTaskRequest $request)
    {
        // Validate request fields before processing
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'assigned_to' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'status' => 'in:pending,in_progress,completed',
            'due_date' => 'required|date',
        ]);

        // Delegate creation to the service
        $this->taskService->createTask($validated);

        // Redirect with success message
        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    /**
     * Show a specific task.
     */
    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form to edit an existing task.
     */
    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified task.
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        // Validate the fields again before update
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'assigned_to' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'status' => 'in:pending,in_progress,completed',
            'due_date' => 'required|date',
        ]);

        // Use service to update the task
        $this->taskService->updateTask($task, $validated);

        // Redirect back with a success message
        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    /**
     * Remove the specified task using the TaskService.
     */
    public function destroy(Task $task)
    {
        $this->taskService->deleteTask($task);

        return redirect()->route('tasks.index')->with('deleted', 'Task deleted successfully.');
    }
}
