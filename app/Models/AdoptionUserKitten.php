<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdoptionUserKitten extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'id_usuario_adoptivo');
    }

    public function kitten()
    {
        return $this->belongsTo(Kitten::class, 'id_gato');
    }

    public function shelter()
    {
        return $this->belongsTo(Shelter::class, 'id_refugio');
    }
}
