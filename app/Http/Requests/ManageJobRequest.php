<?php

namespace App\Http\Requests;

use App\Models\Job;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ManageJobRequest extends FormRequest
{
    public function authorize(): bool
    {
        return (bool) $this->user()?->is_admin;
    }

    protected function prepareForValidation(): void
    {
        $this->merge(['is_featured' => $this->boolean('is_featured')]);
    }

    public function rules(): array
    {
        $job = $this->route('job');

        return [
            'department_id' => ['required', 'integer', 'exists:departments,id'],
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/', Rule::unique('jobs', 'slug')->ignore($job)],
            'location' => ['required', 'string', 'max:255'],
            'employment_type' => ['required', Rule::in(array_keys(Job::employmentTypeOptions()))],
            'salary' => ['nullable', 'string', 'max:255'],
            'experience' => ['nullable', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:20000'],
            'requirements' => ['required', 'string', 'max:20000'],
            'benefits' => ['required', 'string', 'max:20000'],
            'deadline' => ['nullable', 'date'],
            'status' => ['required', Rule::in(array_keys(Job::statusOptions()))],
            'is_featured' => ['required', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'slug.regex' => 'Slug chỉ gồm chữ thường, số và dấu gạch ngang.',
            'slug.unique' => 'Slug này đã được sử dụng.',
        ];
    }
}
