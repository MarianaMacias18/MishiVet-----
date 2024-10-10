@extends('layout')  <!-- Extiende del layout base que contiene la estructura HTML -->

@section('title', 'Dashboard')  <!-- Título de la página -->

@section('content') <!-- Sección del contenido principal -->
    @if(Auth::check())
        <div class="container mt-5">
            <h2 class="text-center">Bienvenido a MishiVet, {{ Auth::user()->name }}</h2>

            <div class="mt-3 text-center">
                <p><a href="{{ route('users.show', Auth::user()->name) }}" class="btn btn-primary">Ver Perfil</a></p>
            </div>

            <!-- Formulario de Logout -->
            <form action="{{ route('users.logout') }}" method="POST" class="text-center">
                @csrf
                <button type="submit" class="btn btn-danger">Cerrar Sesión</button>
            </form>
            @if (session('first_login'))
                <!-- Mensaje de éxito -->
                <x-alert type="success" message="¡Has iniciado sesión con éxito!" />

                @php
                    // Eliminar el indicador de la sesión después de mostrar el mensaje
                    session()->forget('first_login');
                @endphp
            @endif
        </div>
    @else
        <div class="container mt-5">
            <h2 class="text-center">Bienvenido, Invitado</h2>
        </div>
    @endif
@endsection <!-- Fin de la sección -->
