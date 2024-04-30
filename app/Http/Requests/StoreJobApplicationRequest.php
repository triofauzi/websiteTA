<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreJobApplicationRequest extends FormRequest
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
            'full_name' => 'required|string|max:255',
            'residence_address' => 'required|string|max:255',
            'gender' => 'required|in:laki-laki,perempuan',
            'phone_number' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'date_of_birth' => 'required|date',
            'place_of_birth' => 'required|string|max:255',
            'curriculum_vitae' => 'required|file|mimes:pdf,doc,docx|max:20480',
            'job_position_id' => 'required|exists:job_positions,id',
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
            'full_name.required' => 'The full name field is required.',
            'full_name.string' => 'The full name must be a string.',
            'full_name.max' => 'The full name may not be greater than :max characters.',

            'residence_address.required' => 'The residence address field is required.',
            'residence_address.string' => 'The residence address must be a string.',
            'residence_address.max' => 'The residence address may not be greater than :max characters.',

            'gender.required' => 'The gender field is required.',
            'gender.in' => 'The gender field must be either Male or Female.',

            'phone_number.required' => 'The phone number field is required.',
            'phone_number.string' => 'The phone number must be a string.',
            'phone_number.max' => 'The phone number may not be greater than :max characters.',

            'email.required' => 'The email field is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.max' => 'The email may not be greater than :max characters.',

            'date_of_birth.required' => 'The date of birth field is required.',
            'date_of_birth.date' => 'Please enter a valid date of birth.',

            'place_of_birth.required' => 'The place of birth field is required.',
            'place_of_birth.string' => 'The place of birth must be a string.',
            'place_of_birth.max' => 'The place of birth may not be greater than :max characters.',

            'curriculum_vitae.required' => 'The curriculum vitae field is required.',
            'curriculum_vitae.file' => 'Please upload a valid file.',
            'curriculum_vitae.mimes' => 'The curriculum vitae must be a file of type: pdf, doc, docx.',
            'curriculum_vitae.max' => 'The curriculum vitae may not be greater than :max kilobytes.',

            'job_position_id.required' => 'The job position is required.',
            'job_position_id.exists' => 'The selected job position is invalid.',
        ];
    }
}
