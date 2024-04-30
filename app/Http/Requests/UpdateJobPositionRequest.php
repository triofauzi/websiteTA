<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateJobPositionRequest extends FormRequest
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
     * @return array<string, string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:job_positions,id',
            'department' => 'required|string|max:255',
            'salary_range' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'job_type' => 'required|string|max:255',
            'job_place' => 'nullable|string|max:255',
            'expected_experience' => 'required|string|max:255',
            'is_need_candidate' => 'nullable',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'The name field is required.',
            'name.string' => 'The name must be a string.',
            'name.max' => 'The name may not be greater than :max characters.',

            'parent_id.exists' => 'The selected parent job position is invalid.',

            'department.required' => 'The department field is required.',
            'department.string' => 'The department must be a string.',
            'department.max' => 'The department may not be greater than :max characters.',

            'salary_range.string' => 'The salary range must be a string.',
            'salary_range.max' => 'The salary range may not be greater than :max characters.',

            'description.string' => 'The description must be a string.',

            'job_type.required' => 'The job type field is required.',
            'job_type.string' => 'The job type must be a string.',
            'job_type.max' => 'The job type may not be greater than :max characters.',

            'job_place.string' => 'The job place must be a string.',
            'job_place.max' => 'The job place may not be greater than :max characters.',

            'expected_experience.required' => 'The expected experience field is required.',
            'expected_experience.string' => 'The expected experience must be a string.',
            'expected_experience.max' => 'The expected experience may not be greater than :max characters.',

            'is_need_candidate.required' => 'The is need candidate field is required.',
            'is_need_candidate.in' => 'The is need candidate field must be either Y or N.',
        ];
    }
}
