<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        //Administrador
        User::factory()->create([
            'name' => 'Admin Workspace',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password123'),
        ]);

        //Cliente (Profesional)
        User::factory()->create([
            'name' => 'Cliente Profesional',
            'email' => 'cliente@cliente.com',
            'password' => bcrypt('password123'),
        ]);
    }
}