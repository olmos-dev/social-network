<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BuscarRequest extends FormRequest
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
            'name' => ['nullable','max:15','regex:/^[\pL\s\-]+$/u'],
            'username' => ['nullable','max:15','string'],
            'edadMenor' => ['nullable','integer'],
            'edadMayor' => ['nullable','integer'],
            'pais' => ['nullable','exists:pais,id'],
            'genero' => ['nullable','exists:genero,id'],
            'ordenar' => ['nullable','exists:buscar,sort']
        ];
    }

    public function messages(){
        return [
            'name.max' => 'El nombre no debe contener más de 15 caracteres',
            'name.regex' => 'El nombre es inválido.',
            'username.max' => 'El username no debe contener más de 15 caracteres',
            'edadMenor.integer' => 'El primer rango de edad debe ser un número',
            'edadMayor.integer' => 'El segundo rango de edad debe ser un número',
            'pais.exists' => 'El pais seleccionado no existe',
            'genero.exists' => 'El genero seleccionado no existe',
            'ordenar.exists' => 'El orden seleccionado no existe'

        ];
    }
}
