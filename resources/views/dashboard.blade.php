<!DOCTYPE html>
<html lang="es">
<head>
    <title>@yield('title', 'Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    @extends('layout') 

    @section('content') <!-- Sección del contenido principal -->
        @if(Auth::check())
            <h2>Bienvenido a MishiVet, {{ Auth::user()->name }}</h2>
            <div class="mt-3 text-center">
                <p><a href="{{ route('users.show', Auth::user()->name) }}">Perfil</a></p> <!-- Asegúrate de usar Auth::user()->id -->
            </div>
            
            <!-- Formulario de Logout -->
            <form action="{{ route('users.logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="btn btn-danger">Cerrar Sesión</button>
            </form>
        @else
            <h2>Bienvenido, Invitado</h2>
        @endif
    @endsection <!-- Fin de la sección -->
</body>
</html>
