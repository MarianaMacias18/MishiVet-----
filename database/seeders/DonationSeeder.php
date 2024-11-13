<?php

namespace Database\Seeders;

use App\Models\Donation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str; // Importa la clase Str para generar el token aleatorio

class DonationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Donation::create([
            'amount' => 100,
            'date' => now(), // Fecha actual
            'numero_tarjeta' => '4424',
            'token' => Str::random(20), // Token aleatorio de 20 caracteres
            'id_usuario_beneficiario' => 1,
            'id_refugio_beneficiario' => 1,
            'id_usuario_donador' => 2,
            'payment_method' => 'Paypal'
        ]);

        Donation::create([
            'amount' => 520,
            'date' => now(), // Fecha actual
            'numero_tarjeta' => '5590',
            'token' => Str::random(20), // Token aleatorio de 20 caracteres
            'id_usuario_beneficiario' => 2,
            'id_refugio_beneficiario' => 2,
            'id_usuario_donador' => 1,
            'payment_method' => 'Visa'
        ]);
    }
}
