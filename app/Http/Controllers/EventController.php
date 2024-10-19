<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Shelter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Validation\Rule;

class EventController extends Controller
{
    public function index()
    {
        $userId = Auth::id(); // Obtener el ID del usuario autenticado
        $events = Event::with('shelters')
                    ->where('id_usuario_dueño', $userId) // Filtrar eventos por el ID del usuario
                    ->get(); // Obtener eventos con refugios asociados

        return view('events.index', compact('events'));
    }

    public function create()
    {
        // Verificar si el usuario tiene permiso para crear un evento
        $this->authorize('create', Event::class);

        $shelters = Shelter::all(); // Obtener todos los refugios
        return view('events.create', compact('shelters'));
    }

    public function store(Request $request)
    {
        // Validar los campos
        $validatedData = $request->validate([
            'nombre' => ['required','string','max:255', Rule::unique('events')->whereNull('deleted_at'),],
            'fecha' => 'required|date|after:today', 
            'descripcion' => 'required|string', 
            'shelters' => 'required|array', 
            'shelters.*' => 'exists:shelters,id', 
            'ubicacion' => 'required|string|max:255', 
            'participantes' => 'required|integer|min:1',
        ]);

        // Crea el evento con el id_usuario_dueño del usuario autenticado
        $event = Event::create(array_merge($validatedData, [
            'id_usuario_dueño' => Auth::id(), // Asigna el ID del usuario autenticado
        ])); 

        // Asocia refugios al evento
        $event->shelters()->attach($request->shelters, [
            'ubicacion' => $request->ubicacion,
            'participantes' => $request->participantes,
        ]);

        return redirect()->route('events.index')->with('success', 'Evento creado con éxito');
    }


    public function edit(Event $event)
    {
        // Verificar si el usuario tiene permiso para editar el evento
        $this->authorize('update', $event);

        $shelters = Shelter::all();
        return view('events.edit', compact('event', 'shelters'));
    }

    public function update(Request $request, Event $event)
    {
        // Verificar si el usuario tiene permiso para actualizar el evento
        $this->authorize('update', $event);
        
        // Validar los campos
        $validatedData = $request->validate([
            'nombre' => ['required','string','max:255',Rule::unique('events')->ignore($event->id)->whereNull('deleted_at'),],
            'fecha' => 'required|date|after:today', 
            'descripcion' => 'required|string', 
            'shelters' => 'required|array', 
            'shelters.*' => 'exists:shelters,id', 
            'ubicacion' => 'required|string|max:255', 
            'participantes' => 'required|integer|min:1', 
        ]);

        // Actualizar el evento
        $event->update($validatedData);
        
        // Sincronizar refugios seleccionados
        $syncData = [];
        foreach ($request->shelters as $shelterId) {
            $syncData[$shelterId] = [
                'ubicacion' => $request->ubicacion,
                'participantes' => $request->participantes,
                'updated_at' => Carbon::now(), // updated_at 
            ];
        }

        $event->shelters()->sync($syncData);

        return redirect()->route('events.edit',$event)->with('success', '¡Evento actualizado con éxito!');
    }

    public function show(Event $event)
    {
        // Verificar si el usuario tiene permiso para ver el evento
        $this->authorize('view', $event);

        return view('events.show', compact('event'));
    }

    public function destroy(Event $event)
    {
        // Verificar si el usuario tiene permiso para eliminar el evento
        $this->authorize('delete', $event);
        // Eliminar los registros relacionados en la tabla pivote
        $event->shelters()->detach();
        $event->delete();
        return redirect()->route('events.index')->with('success', 'Evento eliminado con éxito');
    }
}
