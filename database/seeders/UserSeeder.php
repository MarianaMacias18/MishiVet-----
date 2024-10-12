<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Sailor Mishi',
            'apellidoP' => 'Luna',
            'apellidoM' => 'Lunita',
            'email' => 'mishivet@gmail.com',
            'password' => Hash::make('mishi123'), // Encrypted password
            'telefono' => '33-22-11-44-55',
            'direccion' => 'Acuario Michin',
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Sailor Venus Mishi',
            'apellidoP' => 'Artemis',
            'apellidoM' => 'Blamquito',
            'email' => 'mishivet2@gmail.com',
            'password' => Hash::make('mishi123'), // Encrypted password
            'telefono' => '33-00-99-77-32',
            'direccion' => 'Michigan',
            'email_verified_at' => now(),
        ]);
        // Crea 10 usuarios de forma aleatoria
        User::factory(10)->create();
      
    }
}
