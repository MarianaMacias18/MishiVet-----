<?php

namespace App\Http\Controllers;

use App\Models\Kitten;
use App\Models\Shelter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class KittenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$userId = Auth::id(); // Obtener el ID del usuario autenticado
        $kittens = Kitten::all(); // Asegúrate de que estás obteniendo todos los gatos
        return view('kittens.index', compact('kittens')); // Pasa los datos a la vista
        //$kittens = Kitten::with('kittens')
        //            ->where('id_usuario_creador', $userId); // Filtrar eventos por el ID del usuario
                    //->get(); // Obtener eventos con refugios asociados
        //$kittens = Kitten::all(); // Traer todos los registros

        return view('kittens.index', compact('kittens')); // Pasar los datos a la vista
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create',kitten::class);
        $shelters = Shelter::all(); 
        return view('kittens.create',compact('shelters'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
     //return $request;
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'raza' => 'required|string|max:255',
            'edad' => 'required|integer',
            'sexo' => 'required|in:macho,hembra',
            'color' => 'required|string|max:255',
            'estado' => 'required|in:adoptado,apartado,libre', 
            'detalles' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'id_refugio' => 'required|exists:shelters,id',
        ]);
        
        // Guardar la imagen
        $path = null;
        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('public/kittens');
            $validatedData['foto'] = basename($path);
        }
    
        $id_usuario_creador = auth()->id(); // Esto obtiene el ID del usuario autenticado

        // Creacion del registro del Mishi
        //$data=([
        Kitten::create([
            'nombre' => $request->nombre,
            'raza' => $request->raza,
            'edad' => $request->edad,
            'sexo' => $request->sexo,
            'color' => $request->color,
            'estado' => $request->estado,
            'detalles' => $request->detalles,
            'foto' => $path, // Aquí se guarda la ruta de la imagen
            'id_refugio' => is_array($request->id_refugio) ? $request->id_refugio[0] : $request->id_refugio, 
            'id_usuario_creador' => $id_usuario_creador,
        ]);

        //dd($data); // Mostrar los datos que se intentan insertar
        // Asociar los refugios
        //$kitten->shelter()->attach($request->id_refugio);
        // Crear el nuevo Kitten
        //$kitten = Kitten::create($data);
    
        return redirect()->route('kittens.index')->with('success', 'Mishi creado exitosamente');
    
    }

    /**
     * Display the specified resource.
     */
    public function show(Kitten $kitten)
    {
        $this->authorize('view',$kitten);
        return view('kittens.show', compact('kitten')); 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kitten $kitten)
    {
        $this->authorize('update',$kitten);
        $shelters = Shelter::all(); 
        return view('kittens.edit', compact('kitten','shelters'));
    }

    /**
     * Update the specified resource in storage.
     */
    
    public function update(Request $request, Kitten $kitten)
    {
       
        $this->authorize('update',$kitten);
        
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'raza' => 'required|string|max:255',
            'edad' => 'required|integer',
            'sexo' => 'required|in:macho,hembra',
            'color' => 'required|string|max:255',
            'estado' => 'required|in:adoptado,apartado,libre',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'detalles' => 'nullable|string',
            'id_refugio' => 'required|exists:shelters,id'
        ]);
       
        //dd($validated);
        // Maneja la eliminación de la foto actual
        if ($request->has('delete_foto') && $request->delete_foto) {
            // Elimina la imagen actual si existe
            if ($kitten->foto && !filter_var($kitten->foto, FILTER_VALIDATE_URL)) {
                Storage::delete('public/kittens/' . $kitten->foto);
                $kitten->foto = null;  // Eliminar referencia a la imagen en la base de datos
            }
        }

        // Maneja la subida de una nueva imagen (foto)
        if ($request->hasFile('foto')) {
            if ($kitten->foto && !filter_var($kitten->foto, FILTER_VALIDATE_URL)) {
                // Eliminar la imagen anterior si existe y no es una URL externa
                Storage::delete('public/kittens/' . $kitten->foto);
            }

            // Guardar la nueva imagen
            $fotoPath = $request->file('foto')->store('kittens', 'public');
            $kitten->foto = basename($fotoPath); // Guardar solo el nombre del archivo
        }
        
      
       
         
        $kitten->update($request->all());
        
    
        //dd($validated);
        return redirect()->route('kittens.index')->with('success', 'Mishi actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kitten $kitten)
    {
        $this->authorize('delete',$kitten);
        $kitten->delete(); // Soft delete (si tienes softDeletes en la migración)
    return redirect()->route('kittens.index')->with('success', 'Mishi eliminado exitosamente');
    }
}
