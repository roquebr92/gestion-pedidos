<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pedido;
use App\Models\Empresa;
use Carbon\Carbon;

class PedidosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Truncate table to avoid duplicates
        Pedido::truncate();

        // For each company, create 3 sample orders
        Empresa::all()->each(function (Empresa $empresa) {
            for ($i = 1; $i <= 3; $i++) {
                Pedido::create([
                    'numero'     => (string) mt_rand(1000, 9999),
                    'fecha'      => Carbon::now()->subDays(mt_rand(1, 60))->toDateString(),
                    'estado_qr'  => ['pendiente', 'ejecutado', 'no_ejecutado'][array_rand(['pendiente', 'ejecutado', 'no_ejecutado'])],
                    'empresa_id' => $empresa->id,
                ]);
            }
        });
    }
}
