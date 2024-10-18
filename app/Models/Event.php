<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded = ['id'];

    public function getRouteKeyName() //Specifies the search field by url
    {
        return 'nombre'; //Search by team name in url 
    }

    protected $casts = [
         'fecha' => 'datetime',
    ];
    #----------------------------------------------------------------
     // Relación N:M con Shelters
    public function shelters()
    {
        return $this->belongsToMany(Shelter::class, 'shelters_events', 'id_evento', 'id_refugio')
                    ->withPivot('ubicacion', 'participantes'); // Incluye los campos adicionales de la tabla pivote
    }
    public function owner()
    {
        return $this->belongsTo(User::class, 'id_usuario_dueño'); // Cambia 'id_usuario_dueño' si el nombre es diferente
    }

}
