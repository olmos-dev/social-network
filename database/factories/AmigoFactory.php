<?php

namespace Database\Factories;

use App\Models\Perfil;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Amigo>
 */
class AmigoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $fecha =  $this->faker->dateTimeBetween('-1 years', (Carbon::now())) ;
        return [
            'usuario_id' => 1,
            'perfil_id' => Perfil::all()->random()->id,
            'estado' =>  $this->faker->randomElement([1,0]),
            'created_at' => $fecha,
            'updated_at' => $fecha
        ];
    }
}
