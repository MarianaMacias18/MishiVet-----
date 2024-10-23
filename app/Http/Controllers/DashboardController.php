<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kitten;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Obtiene todos los mishis que no pertenecen al usuario autenticado y que tienen el estado "pendiente" o "libre"
        $kittens = Kitten::whereDoesntHave('owner', function($query) {
            $query->where('id', auth()->id()); // Excluye los mishis del usuario autenticado
        })
        ->whereIn('estado', ['pendiente', 'libre']) // Filtra solo mishis con estado "pendiente" o "libre"
        ->get();
        
        return view('dashboard', compact('kittens'));
    }
    public function nosotros(){
        return view('nosotros');
    }
    public function notificaciones(){ // Notificaciones de adopcion
         // Obtener las notificaciones del usuario logueado como "solicitante" de Mishis
        $notifications = auth()->user()->customNotifications;
       
        return view('notificaciones', compact('notifications'));
    }
    public function ADMINnotificaciones() {
        // Obtiene las notificaciones del usuario logueado como "dueño" de Shelters
        $userId = auth()->user()->id;
    
        // Obtiene las notificaciones del usuario autenticado como "dueño"
        $notificaciones = Notification::with(['kitten', 'usuarioSolicitante'])
            ->whereIn('estado_notificacion', ['aceptada', 'rechazada'])
            ->where('id_usuario_solicitante', $userId) 
            ->get();
            
        return view('admin_notificaciones', compact('notificaciones'));
    }
    
}
