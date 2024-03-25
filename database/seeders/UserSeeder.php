<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          // Crear un usuario
          User::create([
            'name' => 'Amin',
            'email' => 'admin@wit.la',
            'password' => Hash::make('Wit.la2023'), // Usar Hash::make para cifrar la contraseña
        ]);
    }
}
//php artisan db:seed --class=UserSeeder