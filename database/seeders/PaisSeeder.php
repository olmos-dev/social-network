<?php

namespace Database\Seeders;

use App\Models\Pais;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PaisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pais::create([
           'nombre' => 'México',
           'ruta' => 'mx.svg' 
        ]);

        Pais::create([
            'nombre' => 'Estados Unidos',
            'ruta' => 'us.svg' 
        ]);

        Pais::create([
            'nombre' => 'Canadá',
            'ruta' => 'ca.svg' 
        ]);
    }
}
