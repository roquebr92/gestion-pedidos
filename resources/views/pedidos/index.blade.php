@extends('layouts.app')

@section('title', 'Pedidos pendientes')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-12 mb-3">
      <div class="card table-nowrap table-card overflow-hidden">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h5 class="mb-0">Pedidos pendientes</h5>
        </div>
        <div class="table-responsive">
          <table class="table mb-0">
            <thead class="small text-uppercase bg-body text-muted">
              <tr>
                <th>Comanda</th>
                <th>Fecha</th>
                <th>Estado QR</th>
                <th class="text-end">Acción</th>
              </tr>
            </thead>
            <tbody>
              @foreach($pedidos as $pedido)
                <tr class="align-middle">
                  <td>{{ $pedido->numero }}</td>
                  <td>{{ $pedido->fecha->format('d/m/Y') }}</td>
                  <td>
                    @if($pedido->estado_qr === 'ejecutado')
                      <span class="text-success">Ejecutado</span>
                    @elseif($pedido->estado_qr === 'no_ejecutado')
                      <span class="text-danger">No ejecutado</span>
                    @else
                      <span class="text-muted">Pendiente</span>
                    @endif
                  </td>
                  <td class="text-end">
                    {{-- 1) Ver detalle en modal --}}
                    <button
                      class="btn btn-link p-1"
                      data-bs-toggle="modal"
                      data-bs-target="#detallePedidoModal-{{ $pedido->id }}"
                      title="Ver detalle">
                      <i class="fa fa-eye"></i>
                    </button>

                    {{-- 2) Ir a la página de Generar etiquetas (¡nuevo!) --}}
                    <a
                      href="{{ route('pedidos.etiquetas', $pedido) }}"
                      target="_blank"
                      class="btn btn-link p-1"
                      title="Generar etiquetas QR">
                      <i class="fa fa-qrcode"></i>
                    </a>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- ================================================================= --}}
{{-- MODAL 1: Detalle de la comanda --}}
{{-- ================================================================= --}}
@foreach($pedidos as $pedido)
  <div
    class="modal fade"
    id="detallePedidoModal-{{ $pedido->id }}"
    tabindex="-1"
    aria-labelledby="detallePedidoModalLabel-{{ $pedido->id }}"
    aria-hidden="true"
  >
    <div class="modal-dialog modal-xl modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5
            class="modal-title"
            id="detallePedidoModalLabel-{{ $pedido->id }}"
          >
            Detalle de la comanda {{ $pedido->numero }}
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <dl class="row mb-4">
            <dt class="col-sm-3">Nombre del proveedor</dt>
            <dd class="col-sm-9">{{ $pedido->empresa->nombre }}</dd>
            <dt class="col-sm-3">Pedido</dt>
            <dd class="col-sm-9">{{ $pedido->numero }}</dd>
          </dl>
          <div class="table-responsive">
            <table class="table table-bordered mb-0">
              <thead class="bg-light text-uppercase small">
                <tr>
                  <th>Línea</th>
                  <th>Entrega</th>
                  <th>Almacén Chemical</th>
                  <th>Desc. Chemical</th>
                  <th>Código Proveedor</th>
                  <th>Desc. Proveedor</th>
                  <th>Código</th>
                  <th>Descripción</th>
                  <th>Unidades</th>
                </tr>
              </thead>
              <tbody>
                @foreach($pedido->lineas as $linea)
                  <tr>
                    <td>{{ $linea->linea }}</td>
                    <td>{{ \Carbon\Carbon::parse($linea->entrega)->format('d/m/Y') }}</td>
                    <td>{{ $linea->almacen_chemical }}</td>
                    <td>{{ $linea->descripcion_chemical }}</td>
                    <td>{{ $linea->codigo_proveedor }}</td>
                    <td>{{ $linea->descripcion_proveedor }}</td>
                    <td>{{ $linea->codigo }}</td>
                    <td>{{ $linea->descripcion }}</td>
                    <td>{{ $linea->unidades }}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
        <div class="modal-footer">
          <button
            type="button"
            class="btn btn-secondary"
            data-bs-dismiss="modal">
            Cerrar
          </button>
        </div>
      </div>
    </div>
  </div>
@endforeach

@endsection
