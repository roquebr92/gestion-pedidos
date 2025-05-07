<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Etiquetas Pedido {{ $pedido->numero }}</title>
  <style>
    body { font-family: sans-serif; margin: 0; padding: 0; }
    .label {
      width: 280px;
      border: 1px solid #333;
      padding: 10px;
      margin: 20px auto;
      box-sizing: border-box;
      page-break-after: always;
    }
    .label:last-child { page-break-after: auto; }
    .label h2 { font-size: 16px; margin: 8px 0; text-align: center; }
    .label .datos { font-size: 12px; margin-bottom: 12px; text-align: center; }
  </style>
</head>
<body>
  @foreach($pedido->lineas as $linea)
    <div class="label">
      <h2>Pedido {{ $pedido->numero }}</h2>
      <div class="datos">
        Línea: {{ $linea->linea }}<br>
        Unidades: {{ $linea->unidades }}<br>
        Entrega: {{ \Carbon\Carbon::parse($linea->entrega)->format('d/m/Y') }}
      </div>
      {!! QrCode::size(180)->generate("PEDIDO:{$pedido->numero}|LINEA:{$linea->linea}") !!}
    </div>
  @endforeach
</body>
</html>
