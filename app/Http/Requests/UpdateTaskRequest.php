<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Allow all users for now (can be adjusted for roles)
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'assigned_to' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'status' => 'in:pending,in_progress,completed',
            'due_date' => 'required|date',
        ];
    }
}
