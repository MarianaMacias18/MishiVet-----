<?php

namespace Database\Seeders;

use App\Models\Notification;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Notification::create([
            'notificable_id' => 1, // ID de un usuario o un refugio
            'notificable_type' => 'App\Models\User', // Tipo de entidad
            'fecha' => now(), // Fecha actual
            'estado_notificacion' => 'pendiente', // Estado de la notificación
            'id_gato' => 1, // ID del gato
            'id_usuario_solicitante' => 1, // ID del usuario solicitante
        ]);

        Notification::create([
            'notificable_id' => 2, //  ID de un usuario o un refugio
            'notificable_type' => 'App\Models\Shelter', // Tipo de entidad
            'fecha' => now()->addDays(1), // Fecha futura
            'estado_notificacion' => 'aceptada', // Estado de la notificación
            'id_gato' => 2, // ID del gato
            'id_usuario_solicitante' => 2, // ID del usuario solicitante
        ]);
    }
}
