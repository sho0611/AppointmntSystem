<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePropertyRequest extends FormRequest
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
                'title' => 'required|string|max:20', 
                'description' => 'required|string|max:500',  
                'price' => 'required|numeric|min:0', 
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
            'title.required' => '物件名は必須です。',
            'title.string' => '物件名は文字列で入力してください。',
            'title.max' => '物件名は最大255文字で入力してください。',
            
            'description.required' => '物件の説明は必須です。',
            'description.string' => '物件の説明は文字列で入力してください。',
            'description.max' => '物件の説明は最大500文字で入力してください。',
            
            'price.required' => '価格は必須です。',
            'price.numeric' => '価格は数値で入力してください。',
            'price.min' => '価格は0以上の数値で入力してください。',
        ];
    }    
}
