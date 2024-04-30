<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRetirementRequestRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // You should implement your authorization logic here
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_id' => 'required|exists:users,id',
            'letter' => 'nullable|file|mimes:pdf|max:2048', // Adjust as per your file validation needs
            'status' => 'nullable|in:request,approved,rejected', // Adjust if you have more possible statuses
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'user_id.required' => 'The user ID is required.',
            'user_id.exists' => 'The selected user is invalid.',
            'letter.file' => 'The letter must be a file.',
            'letter.mimes' => 'The letter must be a PDF.',
            'letter.max' => 'The letter must not be greater than 2MB.',
            'status.in' => 'The status must be one of: request, approved, rejected.',
        ];
    }
}
