<?php

namespace Database\Seeders;

use App\Models\Amigo;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AmigoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Amigo::factory()->count(10)->create();
    }
}
