<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Venta;

class VentasTableSeeder extends Seeder
{
    public function run()
    {
        Venta::insert([
            ['vendedor_id' => 1, 'fecha_venta' => '2026-09-03', 'monto' => 700],
            ['vendedor_id' => 1, 'fecha_venta' => '2026-09-18', 'monto' => 1100],

            ['vendedor_id' => 2, 'fecha_venta' => '2026-09-07', 'monto' => 550],
            ['vendedor_id' => 2, 'fecha_venta' => '2026-09-25', 'monto' => 950],

            ['vendedor_id' => 3, 'fecha_venta' => '2026-09-12', 'monto' => 400],

            ['vendedor_id' => 4, 'fecha_venta' => '2026-09-14', 'monto' => 820],
            ['vendedor_id' => 4, 'fecha_venta' => '2026-08-29', 'monto' => 650],  // fuera de rango ejemplo
        ]);
    }
}
