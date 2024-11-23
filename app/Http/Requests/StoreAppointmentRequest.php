<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAppointmentRequest extends FormRequest
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
            'appointmntCustomerName' => 'required|string',
            'appointmntDate' => 'required|date',
            'appointmntTime' => 'required|date_format:H:i',
            'appointmntCustomerPhoneNumber' => 'required|string',
            'appointmntDetail' => 'required|string',    
        ];
    }
}
