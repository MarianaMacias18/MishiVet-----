<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

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
    protected $guarded = ['id', 'password', 'remember_token', 'github_id']; // Campos que no se pueden asignar masivamente (contrario a fileable) <-

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

    public function getRouteKeyName() //Specifies the search field by url
    {
        return 'name'; //Search by team name in url 
    }
    #---------------------------------------------------------------------------------

    // Relación de 1:N: un Usuario tiene muchos Refugios
    public function shelters()
    {
        return $this->hasMany(Shelter::class, 'id_usuario_dueño');
    }
    //Un usuario puede ser dueño de varios Kittens (Al ser dueño de un refugio)
    public function kittens()
    {
        return $this->hasMany(Kitten::class, 'id_usuario_creador');
    }

    public function adoptions()
    {
        return $this->hasMany(AdoptionUserKitten::class, 'id_usuario_adoptivo');
    }
    #---------------------------------------------------------------------------------
     // Relación polimórfica
     public function notifications()
     {
         return $this->morphMany(Notification::class, 'notificable');
     }

}
