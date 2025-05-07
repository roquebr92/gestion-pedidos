<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Database\Seeders\EmpresasSeeder;
use Database\Seeders\UsuariosSeeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        
        $this->call([
            EmpresasSeeder::class,
            UsuariosSeeder::class,
            PedidosSeeder::class,   // <- debe estar aquí
        ]);
    }
}