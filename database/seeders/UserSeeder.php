<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Cria um usuário administrador
        User::create([
            'name' => 'Admin',
            'email' => 'admin@proconecta.com',
            'password' => Hash::make('senha123'),
            'role' => 'admin',
        ]);

        // Cria um usuário atendente
        User::create([
            'name' => 'Atendente',
            'email' => 'atendente@proconecta.com',
            'password' => Hash::make('senha123'),
            'role' => 'atendente',
        ]);

        // Cria um usuário comum
        User::create([
            'name' => 'Usuário Comum',
            'email' => 'usuario@proconecta.com',
            'password' => Hash::make('senha123'),
            'role' => 'user',
        ]);
    }
}