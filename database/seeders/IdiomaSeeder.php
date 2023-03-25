<?php

namespace Database\Seeders;

use App\Models\Idioma;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class IdiomaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Idioma::create([
            'nombre' => 'español',
        ]);

        Idioma::create([
            'nombre' => 'inglés',
        ]);

        Idioma::create([
            'nombre' => 'francés',
        ]);
    }
}
