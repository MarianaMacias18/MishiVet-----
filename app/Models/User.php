<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    /*
    protected $fillable = [ //Fileable limita campos que pueden ser asignados masivamente <- (Evita el acceso a otro te campos desde formularios) 
        'nombre',      
        'apellidoP',   
        'apellidoM',  
        'correo',      
        'telefono',     
        'direccion',   
    ];
    */
    protected $guarded = ['id', 'password', 'remember_token']; // Campos que no se pueden asignar masivamente (contrario a fileable) <-

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [ //Casts asegura que los atributos se conviertan en datos especificos <-
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
