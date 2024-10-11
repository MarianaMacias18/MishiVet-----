<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Carbon\Carbon;

class CleanInactiveUsers extends Command
{
    protected $signature = 'users:clean-inactive';
    protected $description = 'Eliminar usuarios inactivos que no han verificado su correo en los últimos 10 minutos';

    public function handle()
    {
        // Obtener la fecha de 10 minutos atrás
        $tenMinutesAgo = Carbon::now()->subMinutes(10);

        // Buscar y eliminar usuarios que no han verificado su correo y están inactivos
        $deletedUsers = User::where('email_verified_at', null)
            ->where('created_at', '<', $tenMinutesAgo)
            ->delete();

        $this->info("Se han eliminado {$deletedUsers} usuarios inactivos.");
    }
}
