<?php

namespace App\Http\Requests\Task;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:pending,in_progress,completed',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'The task name is required.',
            'name.string' => 'The task name must be a string.',
            'name.max' => 'The task name cannot exceed 255 characters.',
            'status.required' => 'The task status is required.',
            'status.in' => 'The task status must be one of the following: pending, in_progress, completed.',
            'description.string' => 'The description must be a string.',
        ];
    }
}
