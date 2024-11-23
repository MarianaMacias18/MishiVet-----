<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
        public function redirectToGitHub()
        {
            return Socialite::driver('github')->redirect();
        }

        public function handleGitHubCallback()
        {
            $githubUser = Socialite::driver('github')->user();

            // Buscar si ya existe un usuario con el mismo email
            $user = User::where('email', $githubUser->email)->first();

            if ($user) {
                // Si el usuario ya existe pero no tiene github_id, actualiza el github_id
                $user->update([
                    'github_id' => $githubUser->id,
                    'avatar' => $githubUser->avatar,
                    'email_verified_at' => now(), // Marca el email como verificado
                ]);
            } else {
                // Si no existe, crea un nuevo usuario
                $user = User::create([
                    'github_id' => $githubUser->id,
                    'name' => $githubUser->nickname,
                    'email' => $githubUser->email,
                    'avatar' => $githubUser->avatar,
                    'password' => null,
                    'email_verified_at' => now(), // Marca el email como verificado
                ]);
            }
            
            // Autenticar el usuario
            Auth::login($user);
            session(['first_login' => true]);

            return redirect()->route('dashboard.index')->with('success', '¡Has iniciado sesión exitosamente!');
        }
}
