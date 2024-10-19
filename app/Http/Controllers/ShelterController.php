<?php

namespace App\Http\Controllers;

use App\Models\Shelter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ShelterController extends Controller
{
    public function index()
    {
        $shelters = auth()->user()->shelters; // Obtiene solo los refugios del usuario autenticado
        return view('shelters.index', compact('shelters'));
    }

    public function create()
    {
        $this->authorize('create', Shelter::class); // política para autorizar la creación
        return view('shelters.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => ['required', 'string', 'max:255', Rule::unique('shelters')->whereNull('deleted_at')],
            'direccion' => 'required|string|max:255',
            'telefono' => 'required|phone',
            'correo' => 'required|email|unique:shelters,correo',
            'descripcion' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', 
        ]);
        // Maneja la subida de la foto si existe
        if ($request->hasFile('foto')) {
            // Guarda la imagen en el almacenamiento y actualiza el path en $validatedData
            $fotoPath = $request->file('foto')->store('shelters', 'public');
            $validatedData['foto'] = basename($fotoPath); // Guarda solo el nombre del archivo
        }

        $shelter = new Shelter($validatedData);
        $shelter->id_usuario_dueño = auth()->id(); // Asigna el usuario dueño autenticado
        $shelter->save();

        return redirect()->route('shelters.index')->with('success', 'Refugio creado con éxito.');
    }

    public function show(Shelter $shelter)
    {
        $this->authorize('view', $shelter); // política para autorizar la visualización
        return view('shelters.show', compact('shelter'));
    }

    public function edit(Shelter $shelter)
    {
        $this->authorize('update', $shelter); // política para autorizar la edición
        return view('shelters.edit', compact('shelter'));
    }

    public function update(Request $request, Shelter $shelter)
    {
        $this->authorize('update', $shelter); // Política para autorizar la actualización

        $validatedData = $request->validate([
            'nombre' => ['required','string','max:255',Rule::unique('shelters')->ignore($shelter->id)->whereNull('deleted_at'),],
            'direccion' => 'required|string|max:255',
            'telefono' => 'required|phone',
            'correo' => 'required|email|unique:shelters,correo,' . $shelter->id,
            'descripcion' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);
        // Maneja la eliminación de la foto actual
        if ($request->has('delete_foto') && $request->delete_foto) {
            // Elimina la imagen actual si existe y no es una URL externa
            if ($shelter->foto && !filter_var($shelter->foto, FILTER_VALIDATE_URL)) {
                Storage::delete('public/shelters/' . $shelter->foto);
                $shelter->foto = null; // Elimina referencia a la imagen en la base de datos
            }
        }
        // Maneja la subida de la nueva foto si existe
        if ($request->hasFile('foto')) {
            // Elimina la imagen anterior si existe y no es una URL externa
            if ($shelter->foto && !filter_var($shelter->foto, FILTER_VALIDATE_URL)) {
                Storage::delete('public/shelters/' . $shelter->foto);
            }
            // Guarda la nueva imagen y actualiza el path en $validatedData
            $fotoPath = $request->file('foto')->store('shelters', 'public');
            $validatedData['foto'] = basename($fotoPath); // Guarda solo el nombre del archivo
        }
        $shelter->update($validatedData);

        return redirect()->route('shelters.edit', $shelter)->with('success', '¡Refugio actualizado con éxito!.');
    }

    public function destroy(Shelter $shelter)
    {
        // Verificar si el usuario tiene permiso para eliminar el refugio
        $this->authorize('delete', $shelter);
        // Comprobar si el refugio está asociado a kittens
        if ($shelter->kittens()->exists()) {
            return redirect()->route('shelters.index')->with('error', 'No deben haber mishis en el refugio para poder eliminarlo.');
        }
        // Comprobar si el refugio está asociado a eventos
        if ($shelter->events()->exists()) {
            return redirect()->route('shelters.index')->with('error', 'No deben haber eventos relacionados con el refugio para poder eliminarlo.');
        }

        // Eliminar el refugio
        $shelter->delete();

        return redirect()->route('shelters.index')->with('success', 'Refugio eliminado con éxito.');
    }
}
