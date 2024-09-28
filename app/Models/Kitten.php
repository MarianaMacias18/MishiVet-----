<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kitten extends Model
{
    use HasFactory;

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
    
    public function adoptions()
    {
        return $this->hasMany(AdoptionUserKitten::class, 'id_gato');
    }
}
