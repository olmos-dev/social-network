<?php

namespace Database\Seeders;

use App\Models\Genero;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GeneroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Genero::create([
            'nombre' => 'hombre',
            'ruta' => 'fas fa-mars'
        ]);

        Genero::create([
            'nombre' => 'mujer',
            'ruta' => 'fas fa-venus'
        ]);
    }
}
