@extends('layouts.app')

@section('content')
<div class="container py-8">
  <h2 class="text-2xl font-semibold mb-4">Detalle de la comanda {{ $pedido->numero }}</h2>
  <ul class="list-disc pl-5">
    <li><strong>Fecha:</strong> {{ $pedido->fecha->format('d/m/Y') }}</li>
    <li><strong>Estado QR:</strong> {{ ucfirst($pedido->estado_qr) }}</li>
    <li><strong>Empresa ID:</strong> {{ $pedido->empresa_id }}</li>
  </ul>
  <a href="{{ route('pedidos.index') }}" class="mt-4 inline-block text-blue-600">← Volver a pedidos</a>
</div>
@endsection