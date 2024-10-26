<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];
    protected $casts = [
        'date' => 'datetime',
    ];

    // Relación con el modelo User para el beneficiario
    public function beneficiaryUser()
    {
        return $this->belongsTo(User::class, 'id_usuario_beneficiario');
    }

    // Relación con el modelo Shelter para el refugio beneficiario
    public function beneficiaryShelter()
    {
        return $this->belongsTo(Shelter::class, 'id_refugio_beneficiario');
    }

    // Relación con el modelo User para el donante
    public function donorUser()
    {
        return $this->belongsTo(User::class, 'id_usuario_donador');
    }

    // Relación con el modelo Shelter para acceder al refugio de la donación
    public function shelter()
    {
        return $this->beneficiaryShelter(); 
    }
}
