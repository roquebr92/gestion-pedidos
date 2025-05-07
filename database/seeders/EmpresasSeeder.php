<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Empresa;
use Illuminate\Support\Str;

class EmpresasSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'nombre' => 'Power Plastic Europe',
                'logo_url' => 'img/powder-plastic-europe.png',
            ],
            [
                'nombre' => 'Dehisa Cedicam',
                'logo_url' => 'img/dehisa-cedicam.jpg',
            ],
            [
                'nombre' => 'Chemical Wings',
                'logo_url' => 'img/chemical-wings.jpg',
            ],
            [
                'nombre' => 'Quinorgan, SL',
                'logo_url' => 'img/quinorgan.jpg',
            ],
            [
                'nombre' => 'Quintex',
                'logo_url' => 'img/quintex.jpg',
            ],
        ];

        foreach ($data as $empresa) {
            Empresa::create([
                'nombre'     => $empresa['nombre'],
                'email'      => Str::slug($empresa['nombre'], '') . '@example.com',
                'password'   => bcrypt('password123'),
                'empresa_id' => null,
                'logo_url'   => $empresa['logo_url'],
            ]);
        }
    }
}
