Task Management API Documentation
This API enables caseworkers at HMCTS to manage and track their tasks efficiently.

Endpoints

Get All Tasks
Method: GET
Endpoint: /api/tasks
Returns a list of all tasks.
Example Response:

[
  {
    "id": 1,
    "title": "Attend hearing for Case #101",
    "assigned_to": "John Doe",
    "description": "Review witness statements and bring case bundle.",
    "status": "pending",
    "due_date": "2024-06-30T09:00:00",
    "created_at": "2024-05-01T10:00:00",
    "updated_at": "2024-05-01T10:00:00"
  }
]

Get a Task by ID
Method: GET
Endpoint: /api/tasks/{id}
Returns a specific task by ID.
Create a Task
Method: POST
Endpoint: /api/tasks
Creates a new task. Include optional assignment.
Example Request Body:

{
  "title": "Complete Case Review for Smith v. Johnson",
  "assigned_to": "Jane Smith",
  "description": "Summarize findings and draft preliminary report.",
  "status": "pending",
  "due_date": "2024-07-01 17:00:00"
}

Response: 201 Created
Update Task Status
Method: PUT
Endpoint: /api/tasks/{id}/status
Updates the status of a task.
Allowed Values: pending, in_progress, completed
Delete a Task
Method: DELETE
Endpoint: /api/tasks/{id}
Deletes a task.
Example Response:

{
  "message": "Task deleted successfully"
}

Validation Errors
Invalid inputs return 422 status:

{
  "message": "The given data was invalid.",
  "errors": {
    "title": ["The title field is required."]
  }
}

Status Codes

- 200 OK – Successful operation
- 201 Created – Task created
- 404 Not Found – Resource not found
- 422 Unprocessable Entity – Validation failed

