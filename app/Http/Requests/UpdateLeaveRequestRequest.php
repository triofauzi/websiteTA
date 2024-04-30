<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLeaveRequestRequest extends FormRequest
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
            'user_id' => 'nullable|exists:users,id',
            'attachment' => 'nullable|file|max:2048|mimes:jpeg,png,pdf',
            'reason' => 'required|string|max:255',
            'leave_date_from' => 'required|date|after_or_equal:today',
            'leave_date_to' => 'required|date|after_or_equal:leave_date_from',
            'description' => 'required|string',
            'status' => 'string|in:Request',
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
            'user_id.required' => 'User ID is required.',
            'user_id.exists' => 'Selected user does not exist.',
            'attachment.file' => 'Attachment must be a file.',
            'attachment.max' => 'Attachment size must be less than 2MB.',
            'attachment.mimes' => 'Attachment must be a JPEG, PNG, or PDF file.',
            'reason.required' => 'Reason is required.',
            'reason.max' => 'Reason must not exceed 255 characters.',
            'leave_date_from.required' => 'Leave date from is required.',
            'leave_date_from.after_or_equal' => 'Leave date from must be today or in the future.',
            'leave_date_to.required' => 'Leave date to is required.',
            'leave_date_to.after_or_equal' => 'Leave date to must be after or equal to leave date from.',
            'description.required' => 'Description is required.',
            'status.in' => 'Invalid status value.',
        ];
    }
}
