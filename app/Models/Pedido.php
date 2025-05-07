<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $fillable = ['numero', 'fecha', 'estado_qr', 'empresa_id'];
    protected $casts = [
        'fecha' => 'date',      // O 'datetime' si prefieres
    ];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }
    public function lineas()
    {
    return $this->hasMany(PedidoLinea::class);
    }

}
