<?php

namespace App\Http\Controllers;

use App\Models\AdoptionUserKitten;
use App\Models\Shelter; 
use Illuminate\Http\Request;

class AdoptionUserKittenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function indexAdoptador()
    {
        $adoptions = AdoptionUserKitten::where('id_usuario_adoptivo', auth()->id())
            ->whereNotNull('fecha_adopcion') // Adopciones aceptadas
            ->with(['shelter', 'kitten'])
            ->get();

        return view('Adoptions.adoption-history', compact('adoptions'));
    }

    public function indexDueno(Shelter $shelter)
    {
        // Verificar que el usuario autenticado es dueño del refugio, en caso de ser distintos denegar acceso <-
        if (auth()->user()->id != $shelter->id_usuario_dueño) {
            abort(404);
        }

        $adoptions = AdoptionUserKitten::where('id_refugio', $shelter->id)
            ->whereNotNull('fecha_adopcion')
            ->with(['kitten', 'user'])
            ->get();

        return view('Adoptions.shelter-adoption-history', compact('adoptions', 'shelter'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(AdoptionUserKitten $adoptionUserKitten)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AdoptionUserKitten $adoptionUserKitten)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AdoptionUserKitten $adoptionUserKitten)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AdoptionUserKitten $adoptionUserKitten)
    {
        //
    }
}
