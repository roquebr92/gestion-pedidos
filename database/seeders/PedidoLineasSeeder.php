<?php
// database/seeders/PedidoLineasSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pedido;
use App\Models\PedidoLinea;
use Carbon\Carbon;

class PedidoLineasSeeder extends Seeder
{
    public function run(): void
    {
        Pedido::all()->each(function($pedido) {
            for ($i=1; $i<=5; $i++) {
                PedidoLinea::create([
                    'pedido_id'            => $pedido->id,
                    'linea'                => $i,
                    'entrega'              => Carbon::now()->addDays($i)->toDateString(),
                    'almacen_chemical'     => 'Montcada',
                    'descripcion_chemical' => 'Almacén Chemical',
                    'codigo_proveedor'     => '1954-NAT',
                    'descripcion_proveedor'=> 'TPU-AH...',
                    'codigo'               => 'WHT-5390',
                    'descripcion'          => 'WHT-5390',
                    'unidades'             => mt_rand(1,100),
                ]);
            }
        });
    }
}
