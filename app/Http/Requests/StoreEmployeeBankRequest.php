<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeBankRequest extends FormRequest
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
            'account_name' => 'required|string|max:255',
            'account_number' => 'required|string|max:255',
            'currency' => 'required|string|max:255',
            'bank_name' => 'required|string|max:255',
            'bank_branch' => 'required|string|max:255',
            'user_id' => 'nullable|exists:users,id',
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
            'account_name.required' => 'The account name field is required.',
            'account_name.string' => 'The account name must be a string.',
            'account_name.max' => 'The account name may not be greater than :max characters.',

            'account_number.required' => 'The account number field is required.',
            'account_number.string' => 'The account number must be a string.',
            'account_number.max' => 'The account number may not be greater than :max characters.',

            'currency.required' => 'The currency field is required.',
            'currency.string' => 'The currency must be a string.',
            'currency.max' => 'The currency may not be greater than :max characters.',

            'bank_name.required' => 'The bank name field is required.',
            'bank_name.string' => 'The bank name must be a string.',
            'bank_name.max' => 'The bank name may not be greater than :max characters.',

            'bank_branch.required' => 'The bank branch field is required.',
            'bank_branch.string' => 'The bank branch must be a string.',
            'bank_branch.max' => 'The bank branch may not be greater than :max characters.',

            'user_id.exists' => 'The selected user ID is invalid.',
        ];
    }
}
