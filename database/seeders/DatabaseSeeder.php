<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Cria o usuário administrador padrão se ele já não existir
        User::updateOrCreate(
            ['email' => 'admin@autodrive.com'], // <-- Altere para o e-mail padrão que você preferir
            [
                'name' => 'Administrador AutoDrive',
                'password' => Hash::make('senha123'), // <-- Altere para a senha padrão segura que você preferir
            ]
        );
    }
}
