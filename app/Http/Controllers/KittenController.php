<?php

namespace App\Http\Controllers;

use App\Models\Kitten;
use App\Models\Shelter;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;


class KittenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kittens=auth()->user()->kittens;
        //$userId = Auth::id(); // Obtener el ID del usuario autenticado
        //$kittens = Kitten::all(); // Asegúrate de que estás obteniendo todos los gatos
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
        try {
            $this->authorize('create',kitten::class); 
        } catch (AuthorizationException $e) {
            abort(404); // Retornar 404 si la autorización falla
        }

        $shelters = auth()->user()->shelters;
        return view('kittens.create',compact('shelters'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => ['required','string','max:255', Rule::unique('kittens')->whereNull('deleted_at'),],
            'raza' => 'required|string|max:255',
            'edad' => 'required|integer',
            'sexo' => 'required|in:Macho,Hembra',
            'color' => 'required|string|max:255',
            'estado' => 'required|in:Libre',
            'detalles' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'id_refugio' => 'required|exists:shelters,id',
        ]);
        
        // Añade el id del usuario autenticado al array de datos validados
        $validatedData['id_usuario_creador'] = auth()->id();
        
        // Maneja la subida de la foto si existe
        if ($request->hasFile('foto')) {
            // Guarda la imagen y actualiza el path en $validatedData
            $fotoPath = $request->file('foto')->store('kittens', 'public');
            $validatedData['foto'] = basename($fotoPath); // Guarda solo el nombre del archivo
        }

        // Almacena al mishi utilizando asignación masiva
        Kitten::create($validatedData);

        return redirect()->route('kittens.index')->with('success', 'Mishi creado exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kitten $kitten)
    {
        try {
            $this->authorize('view',$kitten);
        } catch (AuthorizationException $e) {
            abort(404); // Retornar 404 si la autorización falla
        }
        return view('kittens.show', compact('kitten')); 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kitten $kitten)
    {
        try {
            $this->authorize('update',$kitten);
        } catch (AuthorizationException $e) {
            abort(404); // Retornar 404 si la autorización falla
        }
        $shelters = auth()->user()->shelters;
        return view('kittens.edit', compact('kitten','shelters'));
    }

    /**
     * Update the specified resource in storage.
     */
    
     public function update(Request $request, Kitten $kitten)
    {
        $validatedData = $request->validate([
            'nombre' => ['required','string','max:255',Rule::unique('kittens')->ignore($kitten->id)->whereNull('deleted_at'),],
            'raza' => 'required|string|max:255',
            'edad' => 'required|integer',
            'sexo' => 'required|in:Macho,Hembra',
            'color' => 'required|string|max:255',
            'estado' => 'required|in:Libre,Apartado,Adoptado',
            'detalles' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'id_refugio' => 'required|exists:shelters,id',
        ]);

        // Añade el id del usuario autenticado al array de datos validados
        $validatedData['id_usuario_creador'] = auth()->id();

        // Maneja la eliminación de la foto actual
        if ($request->has('delete_foto') && $request->delete_foto) {
            // Elimina la imagen actual si existe
            if ($kitten->foto && !filter_var($kitten->foto, FILTER_VALIDATE_URL)) {
                Storage::delete('public/kittens/' . $kitten->foto);
                $kitten->foto = null;  // Eliminar referencia a la imagen en la base de datos
            }
        }
        // Maneja la subida de la foto si existe
        if ($request->hasFile('foto')) {
            // Elimina la imagen anterior si existe y no es una URL externa
            if ($kitten->foto && !filter_var($kitten->foto, FILTER_VALIDATE_URL)) {
                Storage::delete('public/kittens/' . $kitten->foto);
            }

            // Guarda la nueva imagen y actualiza el path en $validatedData
            $fotoPath = $request->file('foto')->store('kittens', 'public');
            $validatedData['foto'] = basename($fotoPath); // Guarda solo el nombre del archivo
        }

        // Actualiza el mishi utilizando asignación masiva
        $kitten->update($validatedData);
        return redirect()->route('kittens.edit',$kitten)->with('success', 'Mishi actualizado exitosamente');
    }

     

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kitten $kitten)
    {
        try {
            $this->authorize('delete', $kitten);
        } catch (AuthorizationException $e) {
            abort(404); // Retornar 404 si la autorización falla
        }

        // Elimina la imagen del Kitten si existe
        if ($kitten->foto) {
            // Ruta completa al archivo en el disco 'public'
            $fotoPath = 'kittens/' . $kitten->foto;

            if (Storage::disk('public')->exists($fotoPath)) {
                Storage::disk('public')->delete($fotoPath); // Elimina la imagen almacenada en public
            }
        }

        $kitten->delete();

        return redirect()->route('kittens.index')->with('success', 'Mishi eliminado exitosamente');
    }
}
