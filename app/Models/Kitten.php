<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kitten extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function getRouteKeyName() //Specifies the search field by url
    {
        return 'nombre'; //Search by team name in url 
    }
    #--------------------------------------------------------
    // Relación inversa: un Kitten pertenece a un refugio
    public function shelter()
    {
        return $this->belongsTo(Shelter::class, 'id_refugio');
    }
    // Relacion inversa: Un Kitten pertenece a un unico dueño (creador de un refugio)
    public function owner()
    {
        return $this->belongsTo(User::class, 'id_usuario_creador');
    }

    public function adoptions()
    {
        return $this->hasMany(AdoptionUserKitten::class, 'id_gato');
    }
}
