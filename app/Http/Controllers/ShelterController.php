<?php

namespace App\Http\Controllers;

use App\Models\Shelter;
use Illuminate\Http\Request;

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
        $request->validate([
            'nombre' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'telefono' => 'required|phone',
            'correo' => 'required|email|unique:shelters,correo',
            'descripcion' => 'nullable|string',
        ]);

        $shelter = new Shelter($request->all());
        $shelter->id_usuario_dueño = auth()->id();
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

        $request->validate([
            'nombre' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'telefono' => 'required|phone',
            'correo' => 'required|email|unique:shelters,correo,' . $shelter->id,
            'descripcion' => 'nullable|string',
        ]);

        $shelter->update($request->all());

        return redirect()->route('shelters.edit', $shelter)->with('success', '¡Refugio actualizado con éxito!.');
    }

    public function destroy(Shelter $shelter)
    {
        $this->authorize('delete', $shelter); // Política para autorizar la eliminación
        $shelter->delete();

        return redirect()->route('shelters.index')->with('success', 'Refugio eliminado con éxito.');
    }
}
