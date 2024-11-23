<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectSpecific
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Rutas específicas que deben redirigir
        $restrictedRoutes = [
            route('dashboard.donate', ['kitten' => $request->kitten]),
            route('dashboard.kittens.show', ['kitten' => $request->kitten]),
        ];

        // Si la URL actual coincide con alguna de las rutas restringidas
        if (in_array($request->url(), $restrictedRoutes)) {
            // Redirige al usuario creador del mishi en caso de querer adoptar o donarse a si mismo al dashboard <-
            if ($request->kitten->id_usuario_creador === Auth::id()) {
            return redirect()->route('dashboard.index');
            }
        }

        return $next($request);
    }
}
