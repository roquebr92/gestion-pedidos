@extends('layouts.app')

@section('title', 'Generar etiquetas')

@section('content')
<div class="max-w-6xl mx-auto">

  {{-- Cabecera --}}
  <div class="flex items-center justify-between mb-8">
    <a href="{{ route('pedidos.index') }}" class="text-blue-600 hover:underline flex items-center">
      <i class="fa fa-arrow-left mr-2"></i> Atrás
    </a>
    <div>
      <h1 class="text-3xl font-bold">Generar etiquetas</h1>
      <p class="italic text-gray-600">Genera el QR de tus pedidos</p>
    </div>
    <div class="w-32">
      <img src="{{ asset($pedido->empresa->logo_url) }}"
           alt="{{ $pedido->empresa->nombre }}"
           class="object-contain"/>
    </div>
  </div>

  {{-- Filtros --}}
  <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
    <div>
      <label class="block text-sm font-semibold mb-1">Pedido</label>
      <input type="text" readonly
             value="{{ $pedido->numero }}"
             class="w-full px-4 py-2 border rounded-lg bg-white"/>
    </div>
    <div>
      <label class="block text-sm font-semibold mb-1">Número de líneas</label>
      <input type="text" readonly
             value="{{ $pedido->lineas->count() }} líneas"
             class="w-full px-4 py-2 border rounded-lg bg-white"/>
    </div>
    <div>
      <label class="block text-sm font-semibold mb-1">Unidades totales</label>
      <input type="text" readonly
             value="{{ $pedido->lineas->sum('unidades') }}"
             class="w-full px-4 py-2 border rounded-lg bg-white"/>
    </div>
  </div>

  {{-- Tabla de líneas --}}
  <div class="overflow-hidden rounded-lg shadow mb-6">
    <table class="min-w-full bg-white">
      <thead class="bg-gray-100 text-gray-700 uppercase text-sm">
        <tr>
          <th class="px-4 py-3">Cant. por envase</th>
          <th class="px-4 py-3">Núm. envase</th>
          <th class="px-4 py-3">Núm. de lote</th>
          <th class="px-4 py-3">Fecha de caducidad</th>
          <th class="px-4 py-3">Palet</th>
          <th class="px-4 py-3">Estado del QR</th>
          <th class="px-4 py-3">Generar QR</th>
        </tr>
      </thead>
      <tbody class="text-gray-600 text-sm">
        @foreach($pedido->lineas as $linea)
          <tr class="border-b last:border-none">
            <td class="px-4 py-3">{{ $linea->cant_por_envase }}</td>
            <td class="px-4 py-3">{{ $linea->num_envase }}</td>
            <td class="px-4 py-3">{{ $linea->num_lote }}</td>
            <td class="px-4 py-3">
              {{ \Carbon\Carbon::parse($linea->fecha_caducidad)->format('d/m/Y') }}
            </td>
            <td class="px-4 py-3">{{ $linea->palet }}</td>
            <td class="px-4 py-3">
              @if($linea->qr_emitido)
                <span class="text-green-600">Emitido</span>
              @else
                <span class="text-red-600">No emitido</span>
              @endif
            </td>
            <td class="px-4 py-3">
              <a href="{{ route('pedidos.qr.image', [$pedido, $linea]) }}"
                 target="_blank"
                 class="inline-flex items-center px-3 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                Ver <i class="fa fa-arrow-right ml-2"></i>
              </a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  {{-- Botón generar todas las etiquetas --}}
  <div class="text-center">
    <a href="{{ route('pedidos.qr.pdf', $pedido) }}"
       class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-semibold rounded-full hover:bg-blue-700"
       target="_blank">
      Generar todas las etiquetas <i class="fa fa-arrow-right ml-2"></i>
    </a>
    <p class="mt-2 text-gray-500 text-sm italic">
      Se descargará un PDF con los QR
    </p>
  </div>

</div>
@endsection
