<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PedidoLinea extends Model
{
    protected $fillable = [
      'pedido_id','linea','entrega','almacen_chemical',
      'descripcion_chemical','codigo_proveedor','descripcion_proveedor',
      'codigo','descripcion','unidades'
    ];

    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }
}
