<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shelter extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    
    public function getRouteKeyName() //Specifies the search field by url
    {
        return 'nombre'; //Search by team name in url 
    }
    #------------------------------------------------------------
    // Relación de 1:N: un Refugio tiene muchos Kittens
    public function kittens()
    {
        return $this->hasMany(Kitten::class, 'id_refugio');
    }

    // Relación inversa: un Refugio pertenece a un usuario
    public function owner()
    {
        return $this->belongsTo(User::class, 'id_usuario_dueño');
    }
    // Relacon 1:N Un Refugio tiene muchas adopciones
    public function adoptionHistories()
    {
        return $this->hasMany(AdoptionUserKitten::class, 'id_refugio');
    }
    #--------------------------------------------------------------------
     // Relation N:m
    public function events()
    {
        return $this->belongsToMany(Event::class, 'shelters_events', 'id_refugio', 'id_evento')
                    ->withPivot('ubicacion', 'participantes'); // Incluye los campos adicionales de la tabla pivote
    }

    #---------------------------------------------------------------------
    // Relación polimórfica
    public function notifications()
    {
        return $this->morphMany(Notification::class, 'notificable');
    }
}
