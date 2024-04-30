<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBiodataRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'identity_number' => 'nullable|string|max:255',
            'salutation' => 'nullable|string|max:255',
            'first_name' => 'nullable|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'gender' => 'nullable|in:laki-laki,perempuan',
            'phone_number' => 'nullable|string|max:20',
            'date_of_birth' => 'nullable|date',
            'place_of_birth' => 'nullable|string|max:255',
            'personal_email' => 'nullable|string|email|max:255',
            'address' => 'nullable|string|max:65535',
        ];
    }

    /**
     * Get custom error messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'identity_number.max' => 'Identity number cannot exceed 255 characters.',
            'salutation.max' => 'Salutation cannot exceed 255 characters.',
            'first_name.max' => 'First name cannot exceed 255 characters.',
            'middle_name.max' => 'Middle name cannot exceed 255 characters.',
            'last_name.max' => 'Last name cannot exceed 255 characters.',
            'gender.in' => 'Gender must be one of: Male, Female, Other.',
            'phone_number.max' => 'Phone number cannot exceed 20 characters.',
            'date_of_birth.date' => 'Date of birth must be a valid date.',
            'place_of_birth.max' => 'Place of birth cannot exceed 255 characters.',
            'personal_email.email' => 'Personal email must be a valid email address.',
            'personal_email.max' => 'Personal email cannot exceed 255 characters.',
            'address.max' => 'Address cannot exceed 65535 characters.',
        ];
    }
}
