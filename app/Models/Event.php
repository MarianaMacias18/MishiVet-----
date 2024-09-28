<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function getRouteKeyName() //Specifies the search field by url
    {
        return 'nombre'; //Search by team name in url 
    }
    #----------------------------------------------------------------
     // Relación N:M con Shelters
     public function shelters()
     {
         return $this->belongsToMany(Shelter::class, 'shelters_events')
                     ->withPivot('ubicacion', 'participantes'); // Incluye los campos adicionales de la tabla pivote
     }
}
