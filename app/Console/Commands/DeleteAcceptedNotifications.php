<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Notification; 
use Carbon\Carbon;

class DeleteAcceptedNotifications extends Command
{
    protected $signature = 'delete:accepted-notifications';
    protected $description = 'Elimina notificaciones aceptadas que tengan más tiempo esperado desde su creación o actualización.';

    public function handle()
    {
        // Calcular la fecha límite de 1 minuto (Testing)
        $fechaLimite = Carbon::now()->subMinutes(5); // Calcula la fecha limite en 10min
        // Casos mejores en tiempo
       // $fechaLimite = Carbon::now()->subHours(24);
       // $fechaLimite = Carbon::now()->subDays(10);

        // Eliminar las notificaciones aceptadas que hayan sido creadas o actualizadas antes de la fecha límite
        $eliminadas = Notification::where('estado_notificacion', 'aceptada')
            ->where(function ($query) use ($fechaLimite) {
                $query->where('created_at', '<=', $fechaLimite)
                      ->orWhere('updated_at', '<=', $fechaLimite);
            })
            ->delete();

        // Mensaje de salida
        $this->info("Se han eliminado {$eliminadas} notificaciones aceptadas que eran más antiguas desde su creación o actualización.");
    }
}
