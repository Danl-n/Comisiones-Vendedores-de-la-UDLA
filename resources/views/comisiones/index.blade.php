@extends('layouts.app')

@section('title', 'Comisiones Vendedores de la UDLA')

@section('content')

{{-- Fila 1: Filtro + Resultados --}}
<div class="grid gap-6 grid-cols-1 md:grid-cols-3">

  {{-- 1. Calcular Comisiones --}}
  <div class="bg-white rounded-lg shadow p-6">
    <h2 class="text-lg font-semibold mb-4">Calcular Comisiones</h2>
    <form action="{{ route('comisiones.calcular') }}" method="POST" class="space-y-4">
      @csrf
      <div>
        <label class="block font-medium">Fecha Inicio</label>
        <input type="date" name="fecha_inicio"
               value="{{ old('fecha_inicio', $fecha_inicio ?? '') }}"
               class="mt-1 block w-full border border-gray-300 rounded-md p-2">
        @error('fecha_inicio') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
      </div>
      <div>
        <label class="block font-medium">Fecha Fin</label>
        <input type="date" name="fecha_fin"
               value="{{ old('fecha_fin', $fecha_fin ?? '') }}"
               class="mt-1 block w-full border border-gray-300 rounded-md p-2">
        @error('fecha_fin') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
      </div>
      <button type="submit"
              class="w-full bg-red-700 hover:bg-red-800 text-white py-2 rounded-md">
        Filtrar y Calcular
      </button>
    </form>
  </div>

  {{-- 2. Resultados --}}
  <div class="bg-white rounded-lg shadow p-6 md:col-span-2 overflow-x-auto">
    <h2 class="text-lg font-semibold mb-4">Resultados</h2>

    @isset($resultados)
      <p class="text-sm text-gray-600 mb-2">
        Comisiones desde {{ $fecha_inicio }} hasta {{ $fecha_fin }}
      </p>
      <table class="table-auto w-full text-sm text-left">
        <thead class="bg-gray-100">
          <tr>
            <th class="px-4 py-2">Vendedor</th>
            <th class="px-4 py-2 text-right">Comisión Total</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
          @forelse($resultados as $nombre => $comision)
            <tr>
              <td class="px-4 py-2">{{ $nombre }}</td>
              <td class="px-4 py-2 text-right">${{ number_format($comision, 2) }}</td>
            </tr>
          @empty
            <tr>
              <td colspan="2" class="px-4 py-2 text-center text-gray-500">
                No hay ventas en este rango.
              </td>
            </tr>
          @endforelse
        </tbody>
        @if(count($resultados) > 0)
          <tfoot>
            <tr class="font-semibold border-t">
              <td class="px-4 py-2">Total</td>
              <td class="px-4 py-2 text-right">${{ number_format(array_sum($resultados), 2) }}</td>
            </tr>
          </tfoot>
        @endif
      </table>
    @else
      <p class="text-gray-500 text-sm">
        Seleccione un rango de fechas y presione "Filtrar y Calcular" para ver las comisiones.
      </p>
    @endisset
  </div>

</div>

{{-- Fila 2: Vendedores + Reglas --}}
<div class="grid gap-6 grid-cols-1 md:grid-cols-2 mt-6">

  {{-- 3. Listado de Vendedores --}}
  <div class="bg-white rounded-lg shadow p-6 overflow-x-auto">
    <h2 class="text-lg font-semibold mb-4">Listado de Vendedores</h2>
    <table class="table-auto w-full text-sm text-left">
      <thead class="bg-gray-100">
        <tr>
          <th class="px-4 py-2">Nombre</th>
          <th class="px-4 py-2">Email</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-gray-200">
        @foreach($vendedores as $v)
          <tr>
            <td class="px-4 py-2">{{ $v->nombre }}</td>
            <td class="px-4 py-2">{{ $v->email }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  {{-- 4. Reglas de Comisión --}}
  <div class="bg-white rounded-lg shadow p-6 overflow-x-auto">
    <h2 class="text-lg font-semibold mb-4">Reglas de Comisión</h2>
    <table class="table-auto w-full text-sm text-left">
      <thead class="bg-gray-100">
        <tr>
          <th class="px-4 py-2">Umbral Monto</th>
          <th class="px-4 py-2">Porcentaje</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-gray-200">
        @foreach($reglas as $r)
          <tr>
            <td class="px-4 py-2">${{ number_format($r->umbral_monto, 2) }}</td>
            <td class="px-4 py-2">{{ ($r->porcentaje * 100) . '%' }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
    <p class="text-xs text-gray-500 mt-3">
      A cada venta se le aplica la regla con el mayor umbral que sea menor o igual al monto vendido.
    </p>
  </div>

</div>
@endsection
