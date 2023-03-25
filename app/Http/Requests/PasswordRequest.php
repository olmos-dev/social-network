<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'pass' => ['required'],
            'password' => ['required','string','confirmed','min:3'],
        ];
    }

    public function messages(){
        return [
            'pass.required' => ['La contraseña actual es obligatoria']
        ];
    }
}
