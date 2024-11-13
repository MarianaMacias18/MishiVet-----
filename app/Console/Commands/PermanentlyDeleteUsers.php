<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Carbon\Carbon;

class PermanentlyDeleteUsers extends Command
{
    protected $signature = 'users:permanently-delete';
    protected $description = 'Eliminar definitivamente usuarios que han sido eliminados hace más de 10 días';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Obtiene la fecha de hace 10 días
        $tenDaysAgo = Carbon::now()->subDays(10);
         // Testing
        //$tenDaysAgo = Carbon::now()->subMinute();

        // Busca usuarios que hayan sido eliminados (soft-deleted) hace más de 10 días
        $usersToDelete = User::onlyTrashed() // suarios eliminados con SoftDeletes
            ->where('deleted_at', '<', $tenDaysAgo)
            ->get();

        // Cuenta cuántos usuarios se eliminarán permanentemente
        $totalUsers = $usersToDelete->count();

        // Elimina permanentemente a los usuarios que sobre pasen mas de 10 dias de la BD
        $usersToDelete->each(function ($user) {
            $user->forceDelete(); // Elimina permanentemente
        });

        // Muestra un mensaje de confirmación
        $this->info("Se han eliminado permanentemente {$totalUsers} usuarios.");
    }
}
