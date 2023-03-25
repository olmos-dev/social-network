<?php

namespace App\Actions\Fortify;

use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\{User,Perfil};
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            //'password' => $this->passwordRules(),
            'password' => ['required','string','confirmed','min:3'],
            /**Campos adicionales al registro*/
            'pais' => ['required','exists:pais,id'],
            'idioma' => ['required','exists:idioma,id'],
            'cumple' => ['required','date'],
            'genero' => ['required','exists:genero,id'],
            'username' => ['required','min:2'],
        ])->validate();

        /**se crea el usuario*/
        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);

        /**Se crea el perfil*/
        Perfil::create([
            'user_id' => $user->id,
            'genero_id' => $input['genero'],
            'pais_id' => $input['pais'],
            'idioma_id' => $input['idioma'],
            'username' => $input['username'],
            'cumple' => $input['cumple'],
            'slug' => Str::slug($input['username'])
        ]);

        //se retorna la instacia del usuario creado
        return $user;


    }
}
