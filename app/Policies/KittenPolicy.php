<?php

namespace App\Policies;

use App\Models\Kitten;
use App\Models\User;


class KittenPolicy
{
    /**
     * Determine whether the user can view the mishi.
     */
    public function view(User $user, Kitten $kitten)
    {
        return $user->id === $kitten->id_usuario_creador; // Mishi con relacion del propietario
    }

    /**
     * Determine whether the user can update the mishi.
     */
    public function update(User $user, Kitten $kitten)
    {
        return $user->id === $kitten->id_usuario_creador;
    }

    /**
     * Determine whether the user can delete the mishi.
     */
    public function delete(User $user, Kitten $kitten)
    {
        return $user->id === $kitten->id_usuario_creador;
    }

    /**
     * Determine whether the user can create mishis
     */
    public function create(User $user)
    {
        return true; // Todos los usuarios pueden crear mishis
    }

    public function viewAny(User $user)
        {
            return true; 
        }

}
