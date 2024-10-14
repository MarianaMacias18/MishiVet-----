<?php

namespace App\Http\Controllers;

use App\Models\Kitten;
use Illuminate\Http\Request;

class KittenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kittens = Kitten::all(); // Traer todos los registros
        return view('kittens.index', compact('kittens')); // Pasar los datos a la vista
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kittens.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'raza' => 'required|string|max:255',
            'edad' => 'required|integer',
            'sexo' => 'required|in:macho,hembra',
            'color' => 'required|string|max:255',
            'estado' => 'required|in:adoptado,apartado,libre', 
            'detalles' => 'nullable|string',
            'id_refugio' => 'required|exists:shelters,id'
        ]);
    
        // Guardar la imagen
        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('public/kittens');
            $validated['foto'] = basename($path);
        }
    
        Kitten::create($validated); // Crear el nuevo registro
    
        return redirect()->route('kittens.index')->with('success', 'Mishi creado exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kitten $kitten)
    {
        return view('kittens.show', compact('kitten')); 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kitten $kitten)
    {
        return view('kittens.edit', compact('kitten'));
    }

    /**
     * Update the specified resource in storage.
     */
    
    public function update(Request $request, Kitten $kitten)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'raza' => 'required|string|max:255',
            'edad' => 'required|integer',
            'sexo' => 'required|in:macho,hembra',
            'color' => 'required|string|max:255',
            'estado' => 'required|in:adoptado,apartado,libre',
            'foto' => 'nullable|image',
            'detalles' => 'nullable|string',
            'id_refugio' => 'required|exists:shelters,id'
        ]);
    
        // Actualizar la imagen si se carga una nueva no estoy segura si funciona.
        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('public/kittens');
            $validated['foto'] = basename($path);
        }
    
        $kitten->update($validated); // Actualizar el registro
    
        return redirect()->route('kittens.index')->with('success', 'Mishi actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kitten $kitten)
    {
        $kitten->delete(); // Soft delete (si tienes softDeletes en la migración)
    return redirect()->route('kittens.index')->with('success', 'Mishi eliminado exitosamente');
    }
}
