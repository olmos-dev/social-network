<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Perfil;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usuario1 = User::create([
            'name' => 'Alberto',
            'email' => 'alberto@mail.com',
            'password' => Hash::make('12345678')
        ]);

        Perfil::create([
            'user_id' => $usuario1->id,
            'genero_id' => 1,
            'pais_id' => 1,
            'idioma_id' => 1,
            'username' => 'albrth 09',
            'foto' => 'fotos/h4.jpg',
            'cumple' => '1994-05-16',
            'descripcion' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur quis dapibus odio. Interdum et malesuada fames ac ante ipsum primis in faucibus. Quisque sed vestibulum diam. Phasellus laoreet dignissim neque, ac mattis risus aliquet vitae. Praesent nec malesuada neque, ac ultrices tortor. Interdum et malesuada fames ac ante ipsum primis in faucibus. Pellentesque in',
            'slug' => Str::slug('albth 09')
        ]);

        $usuario2 = User::create([
            'name' => 'ana',
            'email' => 'ana@mail.com',
            'password' => Hash::make('12345678')
        ]);

        Perfil::create([
            'user_id' => $usuario2->id,
            'genero_id' => 2,
            'pais_id' => 3,
            'idioma_id' => 3,
            'username' => 'sunflower ng',
            'foto' => 'fotos/m1.jpg',
            'cumple' => '1998-06-21',
            'descripcion' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur quis dapibus odio. Interdum et malesuada fames ac ante ipsum primis in faucibus. Quisque sed vestibulum diam. Phasellus laoreet dignissim neque, ac mattis risus aliquet vitae. Praesent nec malesuada neque, ac ultrices tortor. Interdum et malesuada fames ac ante ipsum primis in faucibus. Pellentesque in',
            'slug' => Str::slug('sunflower ng')
        ]);

        $usuario3 = User::create([
            'name' => 'wilson',
            'email' => 'wilson@mail.com',
            'password' => Hash::make('12345678')
        ]);

        Perfil::create([
            'user_id' => $usuario3->id,
            'genero_id' => 1,
            'pais_id' => 2,
            'idioma_id' => 2,
            'username' => 'calisto ntg',
            'foto' => 'fotos/h2.jpg',
            'cumple' => '1980-02-13',
            'descripcion' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur quis dapibus odio. Interdum et malesuada fames ac ante ipsum primis in faucibus. Quisque sed vestibulum diam. Phasellus laoreet dignissim neque, ac mattis risus aliquet vitae. Praesent nec malesuada neque, ac ultrices tortor. Interdum et malesuada fames ac ante ipsum primis in faucibus. Pellentesque in',
            'slug' => Str::slug('calisto ntg')
        ]);

    }
}
