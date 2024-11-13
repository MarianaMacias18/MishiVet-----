@extends('layout')

@section('title', 'Ver Refugio')

@section('content')
<div class="background-image" style="background-image: url('{{ asset('img/background6.jpg') }}');">
<div class="container mt-5">
    <!-- Título del refugio -->
    <h1 class="text-center text-primary mb-4">{{ $shelter->nombre }}</h1>

    <!-- Imagen del refugio -->
    <div class="text-center mb-4">
        @if ($shelter->foto)
            <img src="{{ asset('storage/shelters/' . $shelter->foto) }}" alt="{{ $shelter->nombre }}" class="rounded-circle img-fluid mb-3" style="width: 150px; height: 150px; object-fit: cover;">
        @else
            <img src="{{ asset('img/icono_refugio.png') }}" alt="Foto por defecto" class="rounded-circle img-fluid mb-3" style="width: 150px; height: 150px; object-fit: cover;">
        @endif
    </div>

    <!-- Información del refugio -->
    <div class="card shadow-sm mb-4" style="background-color: rgba(255, 255, 255, 0.75);">
        <div class="card-body">
            <p class="fs-5"><strong>Dirección:</strong> {{ $shelter->direccion }}</p>
            <p class="fs-5"><strong>Teléfono:</strong> {{ $shelter->telefono }}</p>
            <p class="fs-5"><strong>Correo:</strong> {{ $shelter->correo }}</p>
            <p class="fs-5"><strong>Descripción:</strong> {{ $shelter->descripcion }}</p>
        </div>
    </div>

    <!-- Botones -->
    <div class="mt-3 text-center">
        <!-- Historial de adopciones -->
        <a href="{{ route('shelter-adoption-history', ['refugio' => $shelter->id]) }}" class="btn btn-lg btn-outline-success w-50 mb-3">Consultar historial</a>
        <!-- Botón Volver -->
        <a href="{{ route('shelters.index') }}" class="btn btn-lg btn-outline-primary w-50 mb-3">Volver</a>
        <!-- Botón Editar -->
        <a href="{{ route('shelters.edit', $shelter) }}" class="btn btn-lg btn-outline-warning w-50 mb-3">Editar</a>
    </div>
</div>
</div>
@endsection
