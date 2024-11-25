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
            'customerName' => 'required|string|max:10', 
            'appointmntDate' => 'required|date', 
            'appointmntTime' => 'required|date_format:H:i', 
            'phoneNumber' => 'required|regex:/^0[0-9]{9,10}$/', 
            'detail' => 'nullable|string|max:100', 
            'email' => 'required|email',
        ];
    }

     /**
     * Get the custom messages for validation errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'customerName.required' => '名前は必須です。',
            'appointmntDate.required' => '予約日を入力してください。',
            'appointmntTime.required' => '予約時間を入力してください。',
            'phoneNumber.required' => '電話番号は必須です。',
            'email.required' => 'メールアドレスは必須です。',
            'email.email' => '有効なメールアドレスを入力してください。',
        ];
    }
}
