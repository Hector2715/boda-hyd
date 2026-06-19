<?php

namespace database\seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@boda-hyd.com'], // Evita duplicados si lo corres varias veces
            [
                'name' => 'Héctor & Daniela',
                'password' => Hash::make('Boda2026*'), // Puedes cambiar esta contraseña por la definitiva
            ]
        );
    }
}
