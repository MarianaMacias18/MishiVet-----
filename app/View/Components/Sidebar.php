<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class Sidebar extends Component
{
    public $sidebarOptions;
    public $userName; // Nueva propiedad para el nombre del usuario

    public function __construct()
    {
        $this->sidebarOptions = []; // Inicializar como un array vacío
        $this->userName = Auth::check() ? Auth::user()->name : null; // Obtener el nombre del usuario
    
        // Lógica para definir las opciones del sidebar
        $route = request()->route()->getName();

        $UserRoutes = [
            'dashboard.index',
            'users.show',
            'users.edit',
        ];

        $GuardianRoutes = [
            'dashboard.nosotros',
        ];
    
        if (in_array($route, $UserRoutes)) {
            $this->sidebarOptions = [
                ['label' => 'Adopciones', 'route' => 'dashboard.index', 'icon' => 'bx bxs-donate-heart'],
                ['label' => 'Ser Guardian', 'route' => 'dashboard.index', 'icon' => 'bx bxs-home-heart'],
                ['label' => 'Notificaciones', 'route' => 'dashboard.index', 'icon' => 'bx bx-notification'],
                ['label' => 'Perfil', 'route' => 'users.show', 'params' => [$this->userName], 'icon' => 'bx bx-user'],
                ['label' => 'Nosotros', 'route' => 'dashboard.nosotros', 'icon' => 'bx bx-building-house'],
            ];
        }  elseif (in_array($route, $GuardianRoutes)) {
            $this->sidebarOptions = [
                ['label' => 'Refugios', 'route' => 'dashboard.nosotros', 'icon' => 'bx bx-book-heart'],
                ['label' => 'Mishis', 'route' => 'dashboard.nosotros', 'icon' => 'bx bxs-cat'],
                ['label' => 'Eventos', 'route' => 'dashboard.nosotros', 'icon' => 'bx bx-calendar'],
                ['label' => 'Notificaciones', 'route' => 'dashboard.nosotros', 'icon' => 'bx bx-info-circle'],
                ['label' => 'Volver a adopciones', 'route' => 'dashboard.index', 'icon' => 'bx bxs-caret-left-square'],
            ];
        }
    }

    public function render()
    {
        return view('components.sidebar');
    }
}
