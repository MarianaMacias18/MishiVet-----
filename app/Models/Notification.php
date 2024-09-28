<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

     // Relación polimórfica
     public function notificable()
     {
         return $this->morphTo();
     }
 
     public function kitten()
     {
         return $this->belongsTo(Kitten::class, 'id_gato');
     }
 
     public function usuarioSolicitante()
     {
         return $this->belongsTo(User::class, 'id_usuario_solicitante');
     }
}
