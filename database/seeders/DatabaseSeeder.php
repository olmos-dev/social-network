<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;
use Database\Factories\UsuariosFactory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /**!!!NOTA VERIFICAR COMO SE CARGARN Y SE LLAMAN LOS FACTORIES, PORQUE SE UTILIZA EL NOMBRE DEL MODEL PARA EL FACTORY */
        $this->call(GeneroSeeder::class);
        $this->call(IdiomaSeeder::class);
        $this->call(PaisSeeder::class);
        $this->call(Buscarseeder::class);

        $this->call(UsuarioSeeder::class);
        
        $this->call(UsuariosSeeder::class);
        $this->call(PerfilesSeeder::class);
        $this->call(AmigoSeeder::class);


        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
