<?php

namespace App\Http\Controllers;

use App\Models\AdoptionUserKitten;
use App\Models\Kitten;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    /**
     * Show the form for creating a new resource.
     */
    public function accept(Request $request, Kitten $kitten)
    {
        // Actualiza el estado del mishi
        $kitten->estado = 'Adoptado';
        $kitten->save();

        $direccionRefugio = $kitten->shelter->direccion; // Relación con el modelo Kitten

        // Crea un registro del Mishi Adoptado
        AdoptionUserKitten::create([
            'fecha_adopcion' => now(),
            'ubicacion_refugio' => $direccionRefugio, 
            'id_refugio' => $kitten->id_refugio, 
            'id_usuario_adoptivo' => $request->user()->id, // ID del usuario que adopta
            'id_gato' => $kitten->id, // ID del gato adoptado
        ]);

        // Obtiene la notificación pendiente del usuario "dueño"
        $notificacion = Notification::where('id_gato', $kitten->id)
            ->where('estado_notificacion', 'pendiente')
            ->first();
        if (!$notificacion) {
            return redirect()->back()->with('danger', 'No se encontró la notificación para este mishi.');
        }

        // Verifica que la notificación exista antes de intentar eliminarla
        if ($notificacion) {
            
            // Obtiene al usuario solicitante
            $solicitudUsuario = $notificacion->usuarioSolicitante; // Obtén el usuario de la relación

            //Elimina la notificación pendiente del usuario "dueño"
            $notificacion->delete();
            
            // Envia una nueva notificación al usuario solicitante con status "aceptada"
            Notification::create([
                'notificable_id' => $solicitudUsuario->id,
                'notificable_type' => 'App\Models\Shelter', //Notificacion creada como dueño de un Shelter
                'fecha' => now(),
                'estado_notificacion' => 'aceptada', 
                'id_gato' => $kitten->id,
                'id_usuario_solicitante' => $solicitudUsuario->id,
            ]);
        
        } else {
            return redirect()->back()->with('danger', 'No se encontró una notificación pendiente para este mishi.');
        }
        // Redireccionar de vuelta
        return redirect()->back()->with('success', 'Adopción aceptada y notificación enviada al solicitante.');
    }
    public function reject(Kitten $kitten)
    {
        // Actualiza el estado del mishi
        $kitten->estado = 'Libre';
        $kitten->save();

        // Obtiene la notificación pendiente del usuario "dueño"
        $notificacion = Notification::where('id_gato', $kitten->id)
            ->where('estado_notificacion', 'pendiente')
            ->first();
        if (!$notificacion) {
            return redirect()->back()->with('danger', 'No se encontró la notificación para este mishi.');
        }

        // Verifica que la notificación exista antes de intentar eliminarla
        if ($notificacion) {
            
            // Obtiene al usuario solicitante
            $solicitudUsuario = $notificacion->usuarioSolicitante; // Obtén el usuario de la relación

            //Elimina la notificación pendiente
            $notificacion->delete();
            
            // Envia una nueva notificación al usuario solicitante con el status "rechazada"
            Notification::create([
                'notificable_id' => $solicitudUsuario->id,
                'notificable_type' => 'App\Models\Shelter', //Notificacion creada como dueño de un Shelter
                'fecha' => now(),
                'estado_notificacion' => 'rechazada', 
                'id_gato' => $kitten->id,
                'id_usuario_solicitante' => $solicitudUsuario->id,
            ]);
        
        } else {
            return redirect()->back()->with('danger', 'No se encontró una notificación pendiente para este mishi.');
        }
        // Redireccionar de vuelta
        return redirect()->back()->with('success', 'Solicitud rechazada y notificación enviada al solicitante.');
    }
    #---------------------------------------------------------------------------------------------------
    #---------------------------------------------------------------------------------------------------
    public function store(Kitten $kitten) # Envia una notificacion como "usuario solicitante" 
    {
        $kitten->estado = 'Apartado';
        $kitten->save();
    
        $usuarioSolicitante = Auth::user();
    
        // Verifica que el usuario no sea el dueño del mishi
        if ($kitten->id_usuario_creador == $usuarioSolicitante->id) {
            return redirect()->back()->with('danger', 'No puedes adoptar a tú propio mishi.');
        }
    
        // Verifica si ya existe una notificación de adopción para ese mishi y usuario
        $existingNotification = Notification::where('id_gato', $kitten->id)
            ->where('id_usuario_solicitante', $usuarioSolicitante->id)
            ->where('estado_notificacion', 'pendiente')
            ->first();
    
        if ($existingNotification) {
            return redirect()->back()->with('danger', 'La notificación de adopción ya ha sido enviada, por favor, ponte en contacto con el dueño del refugio.');
        }
    
        // Crea una nueva notificación
        Notification::create([
            'notificable_id' => $kitten->id_usuario_creador, // Dueño del mishi
            'notificable_type' => 'App\Models\User', //Notificacion creada como usuario
            'fecha' => now(),
            'estado_notificacion' => 'pendiente',
            'id_gato' => $kitten->id,
            'id_usuario_solicitante' => $usuarioSolicitante->id
        ]);
    
        // Redirecciona de vuelta 
        return redirect()->back()->with('success', 'Solicitud de adopción enviada correctamente.');
    }
    public function destroy($id) # Elimina una notificacion al ser aceptada por el usuario solicitante
    {
        // Busca la notificación por ID
        $notificacion = Notification::findOrFail($id);
    
        // Elimina la notificación
        $notificacion->delete();
    
        // Redirigir de vuelta
        return redirect()->back()->with('success', '¡Mishi éxito!');
    }
}
