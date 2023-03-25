<?php

namespace Database\Factories;

use App\Models\Pais;
use App\Models\User;
use App\Models\Genero;
use App\Models\Idioma;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Perfil>
 */
class PerfilFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $username  =  $this->faker->unique()->userName();
        $genero = Genero::all()->random()->id;

        /**1 significa hombre */
        if($genero == 1){
            return [
                'user_id' => $this->faker->unique()->numberBetween(4,User::count()),
                'genero_id' => $genero,
                'pais_id' => Pais::all()->random()->id,
                'idioma_id' => Idioma::all()->random()->id,
                'username' => $username,
                'foto' => $this->faker->randomElement([
                    'fotos/h1.jpg',
                    'fotos/h2.jpg',
                    'fotos/h3.jpg',
                    'fotos/h4.jpg',
                    'fotos/h5.jpg',
                    'fotos/h6.jpg',
                    'fotos/h7.jpg',
                    'fotos/h8.jpg',
                    'fotos/h9.jpg',
                    'fotos/h10.jpg',
                    'fotos/h11.jpg',
                    'fotos/h12.jpg',
                    'fotos/h13.jpg',
                    'fotos/h14.jpg',
                    'fotos/h15.jpg'
                ]),
                'cumple' => $this->faker->dateTimeBetween('-60 years', (Carbon::now()->subYears(18))),
                'descripcion' => $this->faker->text($maxNbChars = 200),
                'slug' => Str::slug($username),
                'created_at' => $this->faker->dateTimeBetween('-1 years', (Carbon::now()))   
            ];
        }else{
            return [
                'user_id' => $this->faker->unique()->numberBetween(4,User::count()),
                'genero_id' => $genero,
                'pais_id' => Pais::all()->random()->id,
                'idioma_id' => Idioma::all()->random()->id,
                'username' => $username,
                'foto' => $this->faker->randomElement([
                    'fotos/m1.jpg',
                    'fotos/m2.jpg',
                    'fotos/m3.jpg',
                    'fotos/m4.jpg',
                    'fotos/m5.jpg',
                    'fotos/m6.jpg',
                    'fotos/m7.jpg',
                    'fotos/m8.jpg',
                    'fotos/m9.jpg',
                    'fotos/m10.jpg',
                    'fotos/m11.jpg',
                    'fotos/m12.jpg',
                    'fotos/m13.jpg',
                    'fotos/m14.jpg',
                    'fotos/m15.jpg'
                ]),
                'cumple' => $this->faker->dateTimeBetween('-60 years', (Carbon::now()->subYears(18))),
                'descripcion' => $this->faker->text($maxNbChars = 200),
                'slug' => Str::slug($username),
                'created_at' => $this->faker->dateTimeBetween('-1 years', (Carbon::now()))   
            ];
        }
        
       
    }
}
