<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Usuario Administrador
        User::create([
            'name' => 'Administrador Dulce',
            'email' => 'admin@dulcetentacion.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        // Usuario Cliente
        User::create([
            'name' => 'Cliente Dulce',
            'email' => 'cliente@dulcetentacion.com',
            'password' => Hash::make('cliente123'),
            'role' => 'cliente',
        ]);
    }
}