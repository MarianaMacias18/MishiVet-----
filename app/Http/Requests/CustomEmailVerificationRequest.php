<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Auth\EmailVerificationRequest as BaseEmailVerificationRequest;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Auth;

class CustomEmailVerificationRequest extends BaseEmailVerificationRequest
{
    public function authorize()
    {
        // Verifica si el usuario está autenticado
        if (!Auth::check()) {
            // Lanza una excepción de autorización 
            throw new AuthorizationException('La verificación de correo electronico ha expirado.');
        }

        return true; // Permite la verificación si el usuario está autenticado
    }
}
