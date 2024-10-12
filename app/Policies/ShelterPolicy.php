<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Shelter;

class ShelterPolicy
{
    /**
     * Determina si el usuario puede ver cualquier refugio.
     */
    public function viewAny(User $user)
    {
        return true; 
    }

    /**
     * Determina si el usuario puede ver el refugio.
     */
    public function view(User $user, Shelter $shelter)
    {
        return $user->id === $shelter->id_usuario_dueño; // El usuario puede ver el refugio si es el dueño
    }

    /**
     * Determina si el usuario puede crear refugios.
     */
    public function create(User $user)
    {
        return true; // Ajusta según tus necesidades
    }

    /**
     * Determina si el usuario puede actualizar el refugio.
     */
    public function update(User $user, Shelter $shelter)
    {
        return $user->id === $shelter->id_usuario_dueño; // El usuario puede actualizar el refugio si es el dueño
    }

    /**
     * Determina si el usuario puede eliminar el refugio.
     */
    public function delete(User $user, Shelter $shelter)
    {
        return $user->id === $shelter->id_usuario_dueño; // El usuario puede eliminar el refugio si es el dueño
    }
}
