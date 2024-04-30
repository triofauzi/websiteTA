<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePayrollPeriodRequest extends FormRequest
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
            'period_code' => 'required|string|max:255|unique:payroll_periods,period_code',
            'pay_date' => 'required|date',
            'description' => 'nullable|string',
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
            'period_code.required' => 'The period code field is required.',
            'period_code.string' => 'The period code must be a string.',
            'period_code.max' => 'The period code may not be greater than :max characters.',
            'period_code.unique' => 'The period code has already been taken.',

            'pay_date.required' => 'The pay date field is required.',
            'pay_date.date' => 'The pay date must be a valid date.',

            'description.string' => 'The description must be a string.',
        ];
    }
}
