<?php
namespace Database\Seeders;

use App\Models\Empresa;
use App\Models\User; // Asegúrate de usar el modelo correcto
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsuariosSeeder extends Seeder
{
    public function run(): void
    {
        $usuarios = [
            ['email' => 'powerplastic@example.com', 'empresa' => 'Power Plastic Europe'],
            ['email' => 'dehisa@example.com', 'empresa' => 'Dehisa Cedicam'],
            ['email' => 'chemical@example.com', 'empresa' => 'Chemical Wings'],
            ['email' => 'quinorgan@example.com', 'empresa' => 'Quinorgan, SL'],
            ['email' => 'quintex@example.com', 'empresa' => 'Quintex'],
        ];

        foreach ($usuarios as $user) {
            $empresa = Empresa::where('nombre', $user['empresa'])->first();

            if ($empresa) {
                User::create([  // Cambiar 'User' por 'Usuario'
                    'name'     => $user['empresa'],
                    'email'      => $user['email'],
                    'password'   => Hash::make('password'),
                    'empresa_id' => $empresa->id,
                ]);
            }
        }
    }
}

