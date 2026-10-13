<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vendedor;
use App\Models\Venta;
use App\Models\Regla;

class ComisionController extends Controller
{
    /**
     * Muestra el formulario, lista de vendedores y reglas.
     */
    public function index()
    {
        $vendedores = Vendedor::select('nombre','email')->get();
        $reglas      = Regla::orderBy('umbral_monto')->get();

        return view('comisiones.index', compact('vendedores','reglas'));
    }

    /**
     * Procesa el filtro por fechas, calcula comisiones
     * y vuelve a mostrar todo (incluyendo reglas).
     */
    public function calcular(Request $request)
    {
        $data = $request->validate([
            'fecha_inicio' => 'required|date',
            'fecha_fin'    => 'required|date|after_or_equal:fecha_inicio',
        ], [
            'required'       => 'Este campo es obligatorio.',
            'date'           => 'Debe ingresar una fecha válida.',
            'after_or_equal' => 'La fecha fin debe ser igual o posterior a la fecha inicio.',
        ]);

        // Ventas dentro del rango
        $ventas = Venta::with('vendedor')
            ->whereBetween('fecha_venta', [
                $data['fecha_inicio'],
                $data['fecha_fin'],
            ])->get();

        // Cálculo de comisiones
        $resultados = [];
        foreach ($ventas as $venta) {
            $nombre     = $venta->vendedor->nombre;
            $regla      = Regla::where('umbral_monto','<=',$venta->monto)
                               ->orderByDesc('umbral_monto')
                               ->first();
            $porcentaje = $regla?->porcentaje ?? 0;
            $comision   = $venta->monto * $porcentaje;

            $resultados[$nombre] = ($resultados[$nombre] ?? 0) + $comision;
        }

        // Datos para la vista
        $vendedores   = Vendedor::select('nombre','email')->get();
        $reglas       = Regla::orderBy('umbral_monto')->get();

        return view('comisiones.index', [
            'vendedores'   => $vendedores,
            'reglas'       => $reglas,
            'resultados'   => $resultados,
            'fecha_inicio' => $data['fecha_inicio'],
            'fecha_fin'    => $data['fecha_fin'],
        ]);
    }
}
