<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Vendedor;

class VendedoresTableSeeder extends Seeder
{
    public function run()
    {
        Vendedor::insert([
            ['nombre' => 'Andrea Torres',  'email' => 'andrea.torres@udla.edu.ec'],
            ['nombre' => 'Luis Mendoza',   'email' => 'luis.mendoza@udla.edu.ec'],
            ['nombre' => 'Sofía Herrera',  'email' => 'sofia.herrera@udla.edu.ec'],
            ['nombre' => 'Pablo Vega',     'email' => 'pablo.vega@udla.edu.ec'],
        ]);
    }
}
