<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeePayrollRequest extends FormRequest
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
            'salary' => 'nullable|numeric', // adjust validation rules as per your requirements
            'employee_bank_id' => 'nullable|exists:employee_bank,id',
            'user_id' => 'required|exists:users,id',
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
            'salary.numeric' => 'The salary must be a number.',
            'employee_bank_id.exists' => 'The selected employee bank is invalid.',
            'user_id.required' => 'The user ID is required.',
            'user_id.exists' => 'The selected user is invalid.',
        ];
    }
}
