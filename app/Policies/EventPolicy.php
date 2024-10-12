<?php

namespace App\Policies;

use App\Models\Event;
use App\Models\User;

class EventPolicy
{
    /**
     * Determine whether the user can view the event.
     */
    public function view(User $user, Event $event)
    {
        return $user->id === $event->owner->id; // Asegúrate de que el evento tenga una relación de propietario
    }

    /**
     * Determine whether the user can update the event.
     */
    public function update(User $user, Event $event)
    {
        return $user->id === $event->owner->id;
    }

    /**
     * Determine whether the user can delete the event.
     */
    public function delete(User $user, Event $event)
    {
        return $user->id === $event->owner->id;
    }

    /**
     * Determine whether the user can create events.
     */
    public function create(User $user)
    {
        return true; // Todos los usuarios pueden crear eventos
    }
}
