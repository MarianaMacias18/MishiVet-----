<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;
use App\Models\Notification; 
use App\Models\User; 
use App\Models\Shelter; 

class Sidebar extends Component
{
    public $sidebarOptions;
    public $userName;
    public $userNotificationCount; // Conteo de notificaciones para usuarios
    public $guardianNotificationCount; // Conteo de notificaciones para guardianes

    public function __construct()
    {
        $this->sidebarOptions = [];
        $this->userName = Auth::check() ? Auth::user()->name : null;
        $this->userNotificationCount = $this->getUserNotificationCount(); // Da el conteo de notificaciones enviadas como usuario
        $this->guardianNotificationCount = $this->getGuardianNotificationCount(); // Da el conteo de notificaciones enviadas como guardián

        $route = request()->route()->getName();

        $UserRoutes = [
            'dashboard.index',
            'users.show',
            'users.edit',
            'dashboard.nosotros',
            'dashboard.admin.notificaciones',
            'dashboard.kittens.show',
            'adoption-history', 
        ];

        $GuardianRoutes = [
            'shelters.index',
            'shelters.create',
            'shelters.edit',
            'shelters.show',
            'events.index',
            'events.create',
            'events.edit',
            'events.show',
            'kittens.index',
            'kittens.create',
            'kittens.edit',
            'kittens.show',
            'dashboard.notificaciones',
            'donations.index',
            'shelter-adoption-history'
        ];

        if (in_array($route, $UserRoutes)) {
            $this->sidebarOptions = [
                ['label' => 'Adopciones', 'route' => 'dashboard.index', 'icon' => 'bx bxs-donate-heart'],
                ['label' => 'Historial de Adopciones', 'route' => 'adoption-history', 'icon' => 'bx bx-history'], 
                ['label' => 'Ser Guardian', 'route' => 'shelters.index', 'icon' => $this->userNotificationCount > 0 ? 'bx bxs-home-heart text-warning' : 'bx bxs-home-heart'],
                ['label' => 'Notificaciones', 'route' => 'dashboard.admin.notificaciones', 'icon' => $this->guardianNotificationCount > 0 ? 'bx bx-notification text-danger' : 'bx bx-notification'], // Cambiar icono a rojo si hay notificaciones
                ['label' => 'Perfil', 'route' => 'users.show', 'params' => [$this->userName], 'icon' => 'bx bx-user'],
                ['label' => 'Nosotros', 'route' => 'dashboard.nosotros', 'icon' => 'bx bx-building-house'],
            ];
        } elseif (in_array($route, $GuardianRoutes)) {
            $this->sidebarOptions = [
                ['label' => 'Refugios', 'route' => 'shelters.index', 'icon' => 'bx bx-book-heart'],
                ['label' => 'Mishis', 'route' => 'kittens.index', 'icon' => 'bx bxs-cat'],
                ['label' => 'Eventos', 'route' => 'events.index', 'icon' => 'bx bx-calendar'],
                ['label' => 'Notificaciones de Adopción', 'route' => 'dashboard.notificaciones', 'icon' => $this->userNotificationCount > 0 ? 'bx bx-info-circle text-danger' : 'bx bx-info-circle'], // Cambiar icono a rojo si hay notificaciones
                ['label' => 'Donaciones', 'route' => 'donations.index', 'icon' => 'bx bx-credit-card-alt'],
                ['label' => 'Volver a adopciones', 'route' => 'dashboard.index', 'icon' => 'bx bxs-caret-left-square'],
                
            ];
        }
    }

    // Obtiene el conteo de notificaciones pendientes para usuarios (Notificaciones de adopcion <-)
    private function getUserNotificationCount()
    {
        if (Auth::check()) {
            return Auth::user()->customNotifications->where('estado_notificacion', 'pendiente')->count();
        }
        return 0; 
    }

    // Obtiene el conteo de notificaciones aceptadas o rechazadas de guardianes (Dueños de Shelters)
    private function getGuardianNotificationCount()
    {
        if (Auth::check()) {
            $userId = Auth::id(); // Obtiene el ID del usuario autenticado
    
            return Notification::where('id_usuario_solicitante', $userId) // Filtra por el usuario solicitante
                ->whereIn('estado_notificacion', ['aceptada', 'rechazada']) // Filtra por estado de notificación
                ->count(); // Cuenta las notificaciones por aceptadas y rechazadas
        }
        return 0; 
    }

    public function render()
    {
        return view('components.sidebar');
    }
}
