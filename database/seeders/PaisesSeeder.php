<?php

namespace Database\Seeders;
use App\Models\Paises;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaisesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Paises::create(['nombre' => 'Miami', 'lat' => 25.7617, 'lon' => -80.1918]);
        Paises::create(['nombre' => 'Orlando', 'lat' => 28.5383, 'lon' => -81.3792]);
        Paises::create(['nombre' => 'NewYork', 'lat' => 40.730610, 'lon' => -73.935242]);
    }
}
